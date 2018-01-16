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
    //$x=json_decode($receta->Data_frontend);
    array_push($x,$jsonC);
    //array_push($x,json_decode($receta->Data_frontend));
    /*$xt= json_encode($x);
    $x= array();
    for($i=0;$i<count(json_decode($xt));$i++){
        $xt2=json_decode($xt);
        array_push($x,$xt2[$i]);
    }
    $xt= json_encode($x);
    //$x= array();
    //array_push($x,json_decode($xt));
    //array_push($x,json_decode($receta->Data_frontend));
    //$xt= json_encode($x);
    //$xt= json_encode($x);
    //$x= json_encode(array(json_decode($receta->Data_frontend),json_decode($receta->Data_frontend)));
    /*$x=json_encode(array(json_decode($x),json_decode($receta->Data_frontend)));
    $x=json_encode(array(json_decode($x),json_decode($receta->Data_frontend)));*/
    //$x=json_decode($x);
    //$json_merge = json_encode($x);
    //$x=;
    $receta->Data_frontend=null;
        //$receta->Data_frontend=$json;
    $receta->save();
    echo count(json_decode($receta->Data_frontend)).'<br><br>';
    //echo $x.'<br><br>';
    //echo json_encode($x).'<br><br>';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{locale}', function ($locale) {
    App::setLocale($locale);

    return view('welcome');
});
