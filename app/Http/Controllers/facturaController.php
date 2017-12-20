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
	    		foreach ($transaction as $key => $t) {
	    			$transaction2=[
	    				'idTransaction_bank'=> $t->id,
	    				'amount'=>$t->amount,
	    				'medico'=>'medico'.$i,
	    			];
	    			$i=$i+1;
	    		}
	    		return view('factura', compact('codigo'))->with('transaction', $transaction2);
	    	}
	    }
	    $transaction= array();
	    //return view('factura',$transaction);
	    return view('factura', compact('codigo'))->with('transaction', $transaction2);
	}
}
