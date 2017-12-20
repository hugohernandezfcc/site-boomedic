<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Auth;

use App\Http\Controllers\Controller;

class facturaController extends Controller
{
	public function fac(){

	    $payment = DB::table('paymentsmethods')->where('owner',1)->get();
	    if(count($payment)>0){
	    	$transaction = DB::table('transaction_bank')->where('paymentmethod',$payment[0]->id)->get();
	    	if(count($transaction)>0){
	    		$i=0;
	    		//return view('factura', compact('codigo'))->with('transaction2', $transaction2);
	    		return view('factura',
	    		[
                'transaction'     => $transaction,
                'medico'    => 'richard'
                //'userId'    => Auth::id(),
                //'username'  => DB::table('users')->where('id', Auth::id() )->value('name'),
                //'photo'  => DB::table('users')->where('id', Auth::id() )->value('profile_photo'),
            ]
	    	}
	    }
	    $transaction2= array();
	    //return view('factura',$transaction);
	    //return view('factura', compact('codigo'))->with('transaction2', $transaction2);
	    return view('factura',$transaction2);
	}
}
