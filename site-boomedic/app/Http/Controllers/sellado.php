<?php
/***************************************************************************
* Descripción: Generacion del sello de una factura en formato xml
*****************************************************************************/

	$cfdi = "CFDI TEST"
    //Archivos del CSD de prueba proporcionados por el SAT.
    //ver http://developers.facturacionmoderna.com/webroot/CertificadosDemo-FacturacionModerna.zip
    $numero_certificado = "00001000000305304226";
    $archivo_cer = 'storage/app/public/csd/00001000000305304226.cer';
	$archivo_key = .'storage/app/public/csd//00001000000305304226.key';
    $archivo_pem = .'storage/app/public/csd//archivo.key.pem';

//Sellar un XML con los CSD de pruebas
$cfdi = sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem);

function sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem){

  //ingresa codificado en base64 el archivo .cer dentro del atributo -certificado- del xml de la factura
  $certificado = str_replace(array('\n', '\r' ), '', base64_encode(file_get_contents($archivo_cer)));
  
  //Genera Cadena Original del XML(factura) y el XSLT(sat)******
  $xdoc = new DomDocument("1.0","UTF-8");
  $xdoc->loadXML($cfdi) or die("XML invalido");

  $XSL = new DOMDocument("1.0","UTF-8");
  $XSL->load('cadenaoriginal_3_3.xslt');
  
  $proc = new XSLTProcessor;
  $proc->importStyleSheet($XSL);
  $cadena_original = trim($proc->transformToXML($xdoc)); 

  //aplica metodo de digestion SHA-1 y Firma la información resultante
  $private = openssl_get_privatekey(file_get_contents($archivo_pem)); //openssl_pkey_get_private
  
  openssl_sign($cadena_original, $crypttext, $private, OPENSSL_ALGO_SHA1);
  openssl_free_key($private);
  //codfifica en base64 la cadena resultante
  $sello = base64_encode($crypttext); 
  //Integra y Guarda la información final al esqueleto del xml, dentro de los atributos especificados
  $c = $xdoc->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3', 'Comprobante')->item(0); 
  $c->setAttribute('sello', $sello);
  $c->setAttribute('certificado', $certificado);
  $c->setAttribute('noCertificado', $numero_certificado);
  return $xdoc->saveXML();
}
?>