<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/antonio', function (){
  
    /***************************************************************************
    * Descripción: Generaracion del sello de una factura en forato xml
    *****************************************************************************/

        $cfdi = Storage::disk('xml_test')->get('CFDI.xml'); 
        echo '<pre>' . str_replace('<', '&lt;', $cfdi) . '</pre>';
        //echo "cfdi sin sellar: ".'<br><br>'.$cfdi;
        //Archivos del CSD de prueba proporcionados por el SAT.
        //ver http://developers.facturacionmoderna.com/webroot/CertificadosDemo-FacturacionModerna.zip
  
        $numero_certificado = "00001000000305304226";
        $archivo_cer = Storage::disk('csd')->get('00001000000305304226.cer');
        $archivo_key = Storage::disk('csd')->get('00001000000305304226.key');
        $archivo_pem = Storage::disk('csd')->get('archivo.key.pem');

    //Sellar un XML con los CSD de pruebas
    
      //ingresa codificado en base64 el archivo .cer dentro del atributo -certificado- del xml de la factura
      //$certificado = str_replace(array('\n', '\r' ), '', base64_encode(file_get_contents($archivo_cer)));  
      $certificado = str_replace(array('\n', '\r' ), '', base64_encode($archivo_cer));
      
      //Genera Cadena Original del XML(factura) y el XSLT(sat)******
      $xdoc = new DomDocument("1.0","UTF-8");
      $xdoc->loadXML($cfdi) or die("XML invalido");

      $XSL = new DOMDocument("1.0","UTF-8");
      $XSL->load('storage/app/public/cadenaoriginal_3_3.xslt');
      
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

      $cfdi = $xdoc;

      echo '<pre>' . str_replace('<', '&lt;', $cfdi) . '</pre>';
    
});
//Route::get('/factura', function () {
	
    /*$users = DB::table('users')->where('id', Auth::id() )->get();
 	$payment = DB::table('paymentsmethods')->where('owner',Auth::id())->get();
 	$transaction = DB::table('transaction_bank')->where('paymentmethod',$payment[0]->id)->get();*/
//foreach ($users as $user)
//{
    //echo $users.'<br>';
    //return view('factura');
//});
Route::get('factura',['as'=>'factura','uses'=>'facturaController@fac']);

Route::get('/perfil-tributario', function () {
    return view('Perfil-Tributario');
});

Route::get('/prueba', function () {
	//$users = DB::table('users')->get();
	//$payments = DB::table('paymentsmethods')->get();
	//$trans = DB::table('transaction_bank')->get();
 	$payment = DB::table('paymentsmethods')->where('owner','1')->get();
 	$users=DB::table('users')->where('id',16)->get();
 	//$payment2 = DB::table('paymentsmethods')->where('owner',1)->get();
 	echo $payment.'<br><br>';
 	//echo $payment2.'<br><br>';
 	//echo $payments.'<br>';
 	//echo $trans.'<br>';
 	//echo $users;

 	$transaction = DB::table('transaction_bank')->where('paymentmethod',$payment[0]->id)->get();
 	echo $transaction.'<br><br>';
 	echo $users;
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{locale}', function ($locale) {
    App::setLocale($locale);

    return view('welcome');
});
