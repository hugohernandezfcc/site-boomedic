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
use App\professional_information;
use App\medical_appointment;


Route::get('/', function () {
    return view('welcome');
});

Route::get('medicines/{folio?}', ['as' => 'recetaa', 'uses' => 'recetaController@show']);

Route::get('receta','recetaController@index');

Route::post('/infoReceta', ['as' => 'infoReceta', 'uses' => 'recetaController@guardarJson']);

Route::get('/prueba', function () { 
	$doc = professional_information::find(16);
	$citas = medical_appointment::where('user_doctor',16)->where('qualification','!=',null)->count();
	echo $citas.'<br>>br>';
	echo $doc->qualification_points/$citas.'<br>>br>';
});

Route::get('/prueba2/{id}', function () { 
	//$doc = professional_information::find(16);
	//$citas = medical_appointment::where('user_doctor',16)->where('qualification',!=,null)->count();
	$citas = medical_appointment::find($id);
	$citas->qualification = null;
	$citas->save();
	echo 'qualification '.$citas->qualification.'<br>>br>';
	//echo $doc->qualification_points/$citas.'<br>>br>';
});

Auth::routes();

Route::get('factura',['as'=>'factura','uses'=>'facturaController@fac']);

Route::get('/qualification/{id}','facturaController@qualification');

Route::post('/update/{id}','perfilTributarioController@update');

Route::get('/perfilTributario',['as'=>'perfilTributario.edit','uses'=>'perfilTributarioController@edit']);

Route::get('/timbrado','selladoController@Timbrado');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{locale}', function ($locale) {
    App::setLocale($locale);

    return view('welcome');
});
