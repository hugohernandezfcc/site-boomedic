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

Route::post('/prueba', function () { 
	/*$user = DB::table('users')->get();
	$recipe=DB::table('recipes_tests')->where('folio',15103161)->get();
    $doctor=DB::table('users')->where('id',$recipe[0]->doctor)->get();
    $patient=DB::table('users')->where('id',$recipe[0]->patient)->get();
    $medicines=DB::table('cli_recipes_tests')->where('cli_recipes_tests.recipe_test',$recipe[0]->id)
        ->join('medicines', 'cli_recipes_tests.medicine', '=', 'medicines.id')
        ->get();
    echo $recipe.'<br><br>';
    echo $doctor.'<br><br>';
    echo $patient.'<br><br>';
    echo $medicines.'<br><br>';*/
    $receta = recipe_test::where('folio',$request->folio)->first();
    $receta->Data_frontend=null;
        $receta->save();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{locale}', function ($locale) {
    App::setLocale($locale);

    return view('welcome');
});
