<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SelladoTimbradoXML33;

class selladoController extends Controller
{
    public function Timbrado(){
    	$hola = SelladoTimbradoXML33::pruebaTimbrado;
    	echo $hola;
    }
}
