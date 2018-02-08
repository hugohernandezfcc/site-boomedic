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
	$doc = professional_information::where('user',16)->first();
	$doctor = users::find(16);
	$citas = medical_appointment::where('user_doctor',16)->where('qualification','!=',null)->count();
	echo 'Doctor '.$doctor->name.'<br><br>';
	echo 'citas totales '.$citas.'<br><br>';
	echo 'total de puntos '.$doc->qualification_points.'<br><br>';
	echo 'promedio '.$doc->qualification_points/$citas.'<br><br>';
});

Route::get('/prueba2', function () { 
	//$doc = professional_information::find(16);
	//$citas = medical_appointment::where('user_doctor',16)->where('qualification',!=,null)->count();
	//$doc = users::find(16);
	//$doc->qualification_points=null;
	//$doc->save();
	$doc = professional_information::where('user',16)->first();
	$doc->qualification_points=null;
	$doc->save();
	//echo "Doctor ".$doctor->name.'<br><br>';
	$citas = medical_appointment::find(7);
	$citas->qualification = null;
	$citas->save();
	$citas2 = medical_appointment::find(14);
	$citas2->qualification = null;
	$citas2->save();
	$citas3 = medical_appointment::find(13);
	$citas3->qualification = null;
	$citas3->save();
	echo 'qualification '.$citas->qualification.'<br><br>';
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
