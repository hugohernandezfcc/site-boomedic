<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//include 'nusoap.php';
use nusoap_client;
//use DOMDocument;
//use App\Controllers\selladoController;
//include(app_path() . '/SelladoTimbradoMF/SelladoTimbradoXML33.php');

class selladoController extends Controller
{
    //
    public function Timbrado() {
   
	    // RFC utilizado para el ambiente de pruebas
	    //$rfc_emisor = "LAN7008173R5";//relacionado con los archivos CSD
	    
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
	   
	   	$x2 = array('claveProdServ'=>'01010101','noIdent'=>'AULOG001','cantidad'=>'5','claveUnidad'=>'H87','tipoUnidad'=>'Pieza','descripcion'=>'Aurriculares USB Logitech','valorUnitario'=>'350.00','importe'=>'1750.00');
	 	$x = array();
		array_push($x,$x2);
		$x2 = array('claveProdServ'=>'43201800','noIdent'=>'USB','cantidad'=>'1','claveUnidad'=>'H87','tipoUnidad'=>'Pieza','descripcion'=>'Memoria USB 32gb marca Kingston','valorUnitario'=>'100.00','importe'=>'100.00');
		array_push($x,$x2);
	  	//$prices = pruebaTimbrado('EMISOR PRUEBA SA DE CV','LAN7008173R5','PUBLICO EN GENERAL','XAXX010101000',1850,1850.00,68050,$x);
	    // generar y sellar un XML con los CSD de pruebas
	    $cfdi = $this->generarXML('EMISOR PRUEBA SA DE CV','LAN7008173R5','PUBLICO EN GENERAL','XAXX010101000',1850,1850.00,68050,$x);
	    //echo 'CFDI sin sellar'.$cfdi;

	    $cfdi = $this->sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem);
	    //echo 'CFDI sellado'.$cfdi;

	    $xml = base64_encode($cfdi);
	    $usuario ='DEMO700101XXX';
	    $clave = 'DEMO700101XXX';
	    $produccion ='NO';   // [NO|SI]
	    
	    $pac = rand(1,10);//toma un servidor al azar

	    $soapclient = new nusoap_client("http://pac".$pac.".multifacturas.com/pac/?wsdl",

	    $esWSDL = true);
	    //$client->soap_defencoding = 'UTF-8';
		//$client->decode_utf8 = FALSE;

	    //Generamos el arreglo con los parametros para timbrado
	    $tim = array('rfc' => $usuario, 'clave' => $clave,'xml' => $xml,'produccion' => $produccion);

	    $respuesta_timbrado = $soapclient->call('timbrar33b64', $tim);
	    echo "<pre>";
	    print_r($respuesta_timbrado);
	    echo "</pre>";

	    echo 'UUID: '.$respuesta_timbrado['uuid'].'<br><br>';

	    //return $respuesta_timbrado['mensaje_original_pac_json'];
	}

	public function sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem) {
	    $private = openssl_pkey_get_private(file_get_contents($archivo_pem));
	    $certificado = str_replace(array('\n', '\r'), '', base64_encode(file_get_contents($archivo_cer)));

	    $xdoc = new \DOMDocument();//DOMDocument::saveXML()
	    $xdoc->loadXML($cfdi) or die("XML invalido");

	    $c = $xdoc->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0); 
	    $c->setAttribute('Certificado', $certificado);
	    $c->setAttribute('NoCertificado', $numero_certificado);

	    $XSL = new \DOMDocument();
	    $XSL->load('utilities/xslt33/cadenaoriginal_3_3.xslt');
	    
	    $proc = new \XSLTProcessor;
	    $proc->importStyleSheet($XSL);

	    $cadena_original = $proc->transformToXML($xdoc);
	    openssl_sign($cadena_original, $sig, $private, 'SHA256');

	    $sello = base64_encode($sig);
	    //echo $sello.'<br><br>';

	    $c->setAttribute('Sello', $sello);
	    
	    return $xdoc->saveXML();
	}

	public function generarXML ($nombreEmisor,$rfcEmisor,$nombreReceptor,$rfcReceptor,$subtotal,$total,$lugarExpedicion,$conceptos) {
	    $fecha_actual = substr( date('c'), 0, 19);
	    //echo $fecha_actual;

	    $cfdi = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
			<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Serie="A" Folio="01" Fecha="$fecha_actual" Sello="" FormaPago="03" NoCertificado="" Certificado="" CondicionesDePago="CONTADO" SubTotal="$subtotal" Moneda="MXN" Total="$total" TipoDeComprobante="I" MetodoPago="PUE" LugarExpedicion="$lugarExpedicion">
			  	<cfdi:Emisor Rfc="$rfcEmisor" Nombre="$nombreEmisor" RegimenFiscal="601"/>
			  	<cfdi:Receptor Rfc="$rfcReceptor" Nombre="$nombreReceptor" UsoCFDI="G01"/>
			  	<cfdi:Conceptos>
XML;
					for($i = 0;$i < count($conceptos);$i++){
					    $claveProdServ = $conceptos[$i]['claveProdServ'];
					    $noIdent = $conceptos[$i]['noIdent'];//NoIdentificacion="$noIdent"no es necesario
					    $cantidad = $conceptos[$i]['cantidad'];
					    $claveUnidad = $conceptos[$i]['claveUnidad'];
					    $tipoUnidad = $conceptos[$i]['tipoUnidad'];
					    $descripcion = $conceptos[$i]['descripcion'];
					    $valorUnitario = $conceptos[$i]['valorUnitario'];
					    $importe = $conceptos[$i]['importe'];
					    $cfdi = $cfdi.<<<XML
					    <cfdi:Concepto ClaveProdServ="$claveProdServ"  Cantidad="$cantidad" ClaveUnidad="$claveUnidad" Unidad="$tipoUnidad" Descripcion="$descripcion" ValorUnitario="$valorUnitario" Importe="$importe" >
					    </cfdi:Concepto>
XML;
					}
					$cfdi = $cfdi.<<<XML
				</cfdi:Conceptos>
			</cfdi:Comprobante>
XML;
		return $cfdi;
	}
}
