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

	    $payment = DB::table('paymentsmethods')->where('owner',Auth::id())->get();
	    if(count($payment)>0){
	    	$transaction = DB::table('transaction_bank')->where('paymentmethod',$payment[0]->id)->get();
	    	if(count($transaction)>0){
	    		return view('factura', compact('codigo'))->with('transaction', $transaction);
	    	}
	    }
	    $transaction=[];
	    //return view('factura',$transaction);
	    return view('factura', compact('codigo'))->with('transaction', $transaction);
	}
}
