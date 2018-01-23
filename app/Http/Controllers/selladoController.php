<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use nusoap_client;
use Auth;
use App\tributaryProfile;

class selladoController extends Controller{
    
    public function Timbrado(Request $request) {
	    
	    # Archivos del CSD de prueba proporcionados por el SAT.
	    # SERIAL de 20 digitos integrado en el archivo .cer
	    $numero_certificado = "20001000000300022815";
	    $archivo_cer = "csd/lan7008173r5.cer";
	    $archivo_key = "csd/lan7008173r5.key";
	    $key_pass = "12345678a";

	    /**
		* Se ejecutan una sola vez para generar los archivos .cer.pem desde .cer y key.pem desde .key dada su password
	    */
	    $archivo_pem = "csd/lan7008173r5.key.pem";

	   	/**
	   	* utilizado para el ambiente de pruebas pero son obligatorios
	   	* $nombreEmisor = 'EMISOR PRUEBA SA DE CV';
	   	* $rfcEmisor = 'LAN7008173R5';
	   	* $regimenFiscal = '601';
	   	* $nombreReceptor = 'PUBLICO EN GENERAL';
	   	* $rfcReceptor = 'XAXX010101000';
	   	* $subtotal = 1850;
	   	* $total = 1850.00; 
	   	* $lugarExpedicion =68050;
	   	* $conceptos = es un array con los conceptos
	   	* $formaPago = 03;
	   	* $condicionesPago = 'CONTADO'
	   	* $metodoPago = 'PUE';
	   	*/

	   	$perfilT = tributaryProfile::where('user',Auth::id())->first();

	  	/**
		* Generar y sellar un XML con los CSD de pruebas
	  	*/
	    $cfdi = $this->generarXML($request->nombreEmisor, $request->rfcEmisor, $request->regimenFiscal, $perfilT->company_legalName, $perfilT->rfc,$request->subtotal, $request->total,$request->lugarExpedicion, $request->conceptos, $request->formaPago, $request->condicionesPago, $request->metodoPago);
	    /*$cfdi = $this->sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem);
	    $xml = base64_encode($cfdi);
	    $usuario ='DEMO700101XXX';
	    $clave = 'DEMO700101XXX';

	    /**
		* [NO|SI] para declarar si se está en producción o no.
	    */
	    $produccion ='NO';
	    
	    /**
		* Toma un servidor al azar.
	    *//*
	    $pac = rand(1,10);

	    $soapclient = new nusoap_client("http://pac".$pac.".multifacturas.com/pac/?wsdl",
	    $esWSDL = true);

	    /**
	    * Generamos el arreglo con los parametros para timbrado.
	    *//*
	    $tim = array('rfc' => $usuario, 'clave' => $clave,'xml' => $xml,'produccion' => $produccion);

	    $respuesta_timbrado = $soapclient->call('timbrar33b64', $tim);
	    echo "<pre>";
	    dd($respuesta_timbrado);
	    echo "</pre>";

	    echo 'UUID: '.$respuesta_timbrado['uuid'].'<br><br>';
		
	    return $respuesta_timbrado;*/
	    $conceptos = $request->conceptos;
	    return count($conceptos);
	}

	public function sellarXML($cfdi, $numero_certificado, $archivo_cer, $archivo_pem) {
	    $private = openssl_pkey_get_private(file_get_contents($archivo_pem));
	    $certificado = str_replace(array('\n', '\r'), '', base64_encode(file_get_contents($archivo_cer)));

	    $xdoc = new \DOMDocument();
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

	    $c->setAttribute('Sello', $sello);
	    
	    return $xdoc->saveXML();
	}

	public function generarXML ($nombreEmisor,$rfcEmisor,$regimenFiscal,$nombreReceptor,$rfcReceptor,$subtotal,$total,$lugarExpedicion,$conceptos,$formaPago,$condicionesPago,$metodoPago) {
	    $fecha_actual = substr( date('c'), 0, 19);
	    //dd(json_encode($conceptos));
	    $cfdi = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
			<cfdi:Comprobante xmlns:cfdi="http://www.sat.gob.mx/cfd/3" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sat.gob.mx/cfd/3 http://www.sat.gob.mx/sitio_internet/cfd/3/cfdv33.xsd" Version="3.3" Fecha="$fecha_actual" Sello="" FormaPago="$formaPago" NoCertificado="" Certificado="" CondicionesDePago="$condicionesPago" SubTotal="$subtotal" Total="$total" TipoDeComprobante="I" MetodoPago="$metodoPago" LugarExpedicion="$lugarExpedicion">
			  	<cfdi:Emisor Rfc="$rfcEmisor" Nombre="$nombreEmisor" RegimenFiscal="$regimenFiscal"/>
			  	<cfdi:Receptor Rfc="$rfcReceptor" Nombre="$nombreReceptor" UsoCFDI="G01"/>
			  	<cfdi:Conceptos>
XML;
					for($i = 0;$i < count($conceptos);$i++){
					    $claveProdServ = $conceptos[$i]->claveProdServ;
					    $noIdent = $conceptos[$i]->noIdent;//NoIdentificacion="$noIdent"no es necesario
					    $cantidad = $conceptos[$i]->cantidad;
					    $claveUnidad = $conceptos[$i]->claveUnidad;
					    $tipoUnidad = $conceptos[$i]->tipoUnidad;
					    $descripcion = $conceptos[$i]->descripcion;
					    $valorUnitario = $conceptos[$i]->valorUnitario;
					    $importe = $conceptos[$i]->importe;
					    $cfdi = $cfdi.<<<XML
					    <cfdi:Concepto ClaveProdServ="$claveProdServ"  Cantidad="$cantidad" ClaveUnidad="$claveUnidad" Unidad="$tipoUnidad" Descripcion="$descripcion" ValorUnitario="$valorUnitario" Importe="$importe" >
					    </cfdi:Concepto>
XML;
					}
					$cfdi = $cfdi.<<<XML
				</cfdi:Conceptos>
			</cfdi:Comprobante>
XML;
		//return $cfdi;
return 'ok';
	}
}
