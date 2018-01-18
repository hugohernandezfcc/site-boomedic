<?php 
/**
 * Descripción: Generando un archivo XML de un CFDI version 3.3, sellarlo y enviandolo a Timbrar(certificar).
 * Fecha de Creación: 09/01/2018
 * Fecha de ultima modificación: 09/01/2018
 * Version: 1.0
 */

date_default_timezone_set('America/Mexico_City');
//include ("lib/nusoap.php");
//include(app_path() . '/SelladoTimbradoMF/lib/nusoap.php');
//use App\Http\SelladoTimbradoMF\lib\nusoap_base;
//include(app_path() . '/SelladoTimbradoMF/lib/nusoap_base.php');
//include(app_path() . '/SelladoTimbradoMF/lib/nusoap_client.php');
use App\Http\SelladoTimbradoMF\lib\nusoap_client; 
//$respuesta_timbrado = pruebaTimbrado();

/*
$uuid = "0057fa0e-6c72-4340-ab54-790726748820";
cancelar($respuesta_timbrado['uuid']);
*/

function pruebaTimbrado() {
   
    // RFC utilizado para el ambiente de pruebas
    $rfc_emisor = "LAN7008173R5";//relacionado con los archivos CSD
    
    //Archivos del CSD de prueba proporcionados por el SAT.
    $numero_certificado = "20001000000300022815"; //SERIAL de 20 digitos integrado en el archivo .cer
    $archivo_cer = "csd/lan7008173r5.cer";
    $archivo_key = "csd/lan7008173r5.key";
    $key_pass = "12345678a";

    /*
    //se ejecutan una sola vez para generar los archivos .cer.pem desde .cer y key.pem desde .key dada su password
    system('openssl x509 -in $archivo_cer -inform DER -out $archivo_cer.pem -outform PEM');
    system('openssl pkcs8 -in $archivo_key -inform DER -passin pass:$key_pass -out $archivo_key.pem -outform PEM');
    */

    $archivo_pem = "csd/lan7008173r5.key.pem";
   
    // generar y sellar un XML con los CSD de pruebas
    $cfdi = generarXML($rfc_emisor);
    //echo 'CFDI sin sellar'.simplexml_load_string($cfdi);
    print_r(simplexml_load_string($cfdi));
    echo '<br><br>';
    
    $cfdi = sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem);
    //echo 'CFDI sellado'.$cfdi;
    //print_r(simplexml_load_string($cfdi));
    echo '<br><br>';
    
    $xml= base64_encode($cfdi);
    $usuario='DEMO700101XXX';
    $clave='DEMO700101XXX';
    $produccion='NO';   // [NO|SI]
    
    $pac=rand(1,10);//toma un servidor al azar
    //$soapbase = new nusoap_base();
    $soapclient = new nusoap_client('http://pac$pac.multifacturas.com/pac/?wsdl',$esWSDL = true);
    echo ($soapclient);
    echo '<br><br>';

    //Generamos el arreglo con los parametros para timbrado
    $tim = array('rfc' => $usuario, 'clave' => $clave,'xml' => $xml,'produccion' => $produccion);

    $respuesta_timbrado = $soapclient->call('timbrar33b64', $tim);
    //print_r(simplexml_load_string($respuesta_timbrado));
    echo json_encode($respuesta_timbrado['uuid']);
    /*echo "<pre>";
    print_r($respuesta_timbrado);
    echo "</pre>";

    echo 'UUID: '.$respuesta_timbrado['uuid'];*/

    //return $respuesta_timbrado;
}

function sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem) {
    $private = openssl_pkey_get_private(file_get_contents($archivo_pem));
    $certificado = str_replace(array('\n', '\r'), '', base64_encode(file_get_contents($archivo_cer)));

    $xdoc = new DomDocument();
    $xdoc->loadXML($cfdi) or die("XML invalido");

    $c = $xdoc->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0); 
    $c->setAttribute('Certificado', $certificado);
    $c->setAttribute('NoCertificado', $numero_certificado);

    $XSL = new DOMDocument();
    $XSL->load('utilities/xslt33/cadenaoriginal_3_3.xslt');
    
    $proc = new XSLTProcessor;
    $proc->importStyleSheet($XSL);

    $cadena_original = $proc->transformToXML($xdoc);
    openssl_sign($cadena_original, $sig, $private, 'SHA256');
    $sello = base64_encode($sig);

    $c->setAttribute('Sello', $sello);
    
    return $xdoc->saveXML();
}

function generarXML ($rfc_emisor) {
    $fecha_actual = substr( date('c'), 0, 19);

    $cfdi = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Serie="A" Folio="01" Fecha="$fecha_actual" Sello="" FormaPago="03" NoCertificado="" Certificado="" CondicionesDePago="CONTADO" SubTotal="1850" Descuento="175.00" Moneda="MXN" Total="1943.00" TipoDeComprobante="I" MetodoPago="PUE" LugarExpedicion="68050">
  <cfdi:Emisor Rfc="$rfc_emisor" Nombre="EMISOR PRUEBA SA DE CV" RegimenFiscal="601"/>
  <cfdi:Receptor Rfc="XAXX010101000" Nombre="PUBLICO EN GENERAL" UsoCFDI="G01"/>
  <cfdi:Conceptos>
    <cfdi:Concepto ClaveProdServ="01010101" NoIdentificacion="AULOG001" Cantidad="5" ClaveUnidad="H87" Unidad="Pieza" Descripcion="Aurriculares USB Logitech" ValorUnitario="350.00" Importe="1750.00" Descuento="175.00">
      <cfdi:Impuestos>
        <cfdi:Traslados>
          <cfdi:Traslado Base="1575.00" Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="252.00"/>
        </cfdi:Traslados>
      </cfdi:Impuestos>
    </cfdi:Concepto>
    <cfdi:Concepto ClaveProdServ="43201800" NoIdentificacion="USB" Cantidad="1" ClaveUnidad="H87" Unidad="Pieza" Descripcion="Memoria USB 32gb marca Kingston" ValorUnitario="100.00" Importe="100.00">
      <cfdi:Impuestos>
        <cfdi:Traslados>
          <cfdi:Traslado Base="100.00" Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="16.00"/>
        </cfdi:Traslados>
      </cfdi:Impuestos>
    </cfdi:Concepto>
  </cfdi:Conceptos>
  <cfdi:Impuestos TotalImpuestosTrasladados="268.00">
    <cfdi:Traslados>
      <cfdi:Traslado Impuesto="002" TipoFactor="Tasa" TasaOCuota="0.160000" Importe="268.00"/>
    </cfdi:Traslados>
  </cfdi:Impuestos>
</cfdi:Comprobante>
XML;
    return $cfdi;
}

//EN PRUEBAS
function cancelar ($uuid){
    // archivos csd para cancelar Timbrado
    $archivo_cer = "csd/lan7008173r5.cer";
    $archivo_key = "csd/lan7008173r5.key.pem";
    $key_pass = "12345678a";

    $certificado = str_replace(array('\n', '\r'), '', base64_encode(file_get_contents($archivo_cer)));
    $key = str_replace(array('\n', '\r'), '', base64_encode(file_get_contents($archivo_key)));

    $usuario='DEMO700101XXX';
    $clave='DEMO700101XXX';
    $produccion='NO';   // [NO|SI]

    $soapclient = new nusoap_client("http://pac$pac.multifacturas.com/pac/?wsdl", $esWSDL = true);

    //Generamos el arreglo con los parametros para cancelar
    $can = array('rfc' => $usuario, 'clave' => $clave, 'uuid' => $uuid, 'cer' => $certificado, 'key' => $key, 'pass_cer' => $key_pass, 'produccion' => $produccion);
    echo $can;

    $respuesta_cancelacion = $soapclient->call('cancelar', $can);
    print_r($respuesta_cancelacion);
}

?>