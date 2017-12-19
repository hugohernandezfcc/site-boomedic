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
Route::get('/factura', function () {

    /*$users = DB::table('users')->where('id', Auth::id() )->get();
 	$payment = DB::table('paymentsmethods')->where('owner',Auth::id())->get();
 	$transaction = DB::table('transaction_bank')->where('paymentmethod',$payment[0]->id)->get();*/
//foreach ($users as $user)
//{
    //echo $users.'<br>';
    return view('factura');
});

Route::get('/prueba', function () {
	//$users = DB::table('users')->where('id', Auth::id() )->get();
 	$payment = DB::table('paymentsmethods')->where('owner',Auth::id())->get();
 	echo $payment;
 	//$transaction = DB::table('transaction_bank')->where('paymentmethod',$payment[0]->id)->get();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{locale}', function ($locale) {
    App::setLocale($locale);

    return view('welcome');
});
