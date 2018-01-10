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

Route::get('medicines/{folio?}', ['as' => 'recetaa', 'uses' => 'RecetaController@show']);

Route::get('receta','recetaController@index');

Route::get('/', function () {
    return view('welcome');
});
Route::get('factura',['as'=>'factura','uses'=>'facturaController@fac']);

Route::post('/update/{id}','perfilTributarioController@update');

Route::get('/perfilTributario',['as'=>'perfilTributario.edit','uses'=>'perfilTributarioController@edit']);

Route::get('/prueba', function () { 
	$user = DB::table('users')->get();
	/*$lab = DB::table('professional_information')->where('user',16)->get();
 	$tp=DB::table('medical_appointments')->get();
    $join = DB::table('medical_appointments')->where('medical_appointments.user',3)//cambiar al usuario de sesion
            ->join('users', 'medical_appointments.user_doctor', '=', 'users.id')
            ->join('professional_information', 'medical_appointments.user_doctor', '=', 'professional_information.user')
            ->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
            ->select('medical_appointments.*', 'users.name', 'users.email', 'users.occupation', 'professional_information.specialty', 'labor_information.workplace', 'labor_information.delegation','labor_information.latitude','labor_information.longitude')
            ->get();
 	echo $lab.'<br><br>';
 	echo $tp.'<br><br>';
    echo $join.'<br><br>';
 	echo $user.'<br><br>';*/
    echo $user.'<br><br>';
    $recipe=DB::table('recipes_tests')->get();
    echo $recipe;

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{locale}', function ($locale) {
    App::setLocale($locale);

    return view('welcome');
});
