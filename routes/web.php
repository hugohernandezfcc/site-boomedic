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
    $current_uri = $_SERVER['SCRIPT_URI'];
    dd('current uri = '.$current_uri);
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
