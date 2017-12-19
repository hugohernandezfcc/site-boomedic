<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class facturaController extends Controller
{
	public function fac()
	    $payment = DB::table('paymentsmethods')->where('owner','1')->get();
	    $transaction = DB::table('transaction_bank')->where('paymentmethod',$payment[0]->id)->get();
	    return view('factura',$transaction);
	}
}
