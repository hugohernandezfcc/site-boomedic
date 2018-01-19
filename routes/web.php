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
use Illuminate\Http\Request;
use App\recipe_test;

Route::get('medicines/{folio?}', ['as' => 'recetaa', 'uses' => 'recetaController@show']);

Route::get('receta','recetaController@index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('factura',['as'=>'factura','uses'=>'facturaController@fac']);

Route::post('/update/{id}','perfilTributarioController@update');

Route::get('/perfilTributario',['as'=>'perfilTributario.edit','uses'=>'perfilTributarioController@edit']);

Route::post('/pru', ['as' => 'pru', 'uses' => 'recetaController@guardarJson']);

Route::get('/prueba', function () { 
	$receta = recipe_test::where('folio','15103161')->first();
    $jsonC= array('type' => '$dis', 'device' => '$device', 'platform' => '$platform'.' '.'$versionP', 'browser' => '$browser'.' '.'$versionB', 'latitud' => '$request->latitud', 'longitud' => '$request->longitud', 'recetaInfo' => array('surtio_completo' =>'$request->surtioC', 'porcentaje' => '$request->porcentaje', 'descripcion' => '$request->descripcion'));
    $x= array();
    array_push($x,$jsonC);
    
    $receta->Data_frontend=null;
    $receta->save();
    //echo count(json_decode($receta->Data_frontend)).'<br><br>';
    echo 'listo';
});
Route::get('/prueba3', function () {
 include(app_path() . '/SelladoTimbradoMF/SelladoTimbradoXML33.php');
  $prices = pruebaTimbrado();
  echo json_encode($prices);
  /*$pricesClass = new ST();
    $prices = $pricesClass->hola();
    echo $prices;*/
    //return view('pages.home', compact('prices'));

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{locale}', function ($locale) {
    App::setLocale($locale);

    return view('welcome');
});
