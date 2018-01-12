<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;

class recetaController extends Controller{
    //
    public function index(){
	    $user=DB::table('users')->get();
	    return view('receta',['receta'=>$user]);
	}
	
    public function show($folio){
	    $recipe=DB::table('recipes_tests')->where('folio',$folio)->get();
		$doctor=DB::table('users')->where('id',$recipe[0]->doctor)->get();
    	$patient=DB::table('users')->where('id',$recipe[0]->patient)->get();
    	$medicines=DB::table('cli_recipes_tests')->where('cli_recipes_tests.recipe_test',$recipe[0]->id)
    		->join('medicines', 'cli_recipes_tests.medicine', '=', 'medicines.id')
    		->get();
    	return response()->json(['recipe'=>$recipe,'doctor'=>$doctor,'patient'=>$patient,'medicines'=>$medicines]);
	}

	public function guardarJson(Request $request){
		$agent = new Agent();
	    if($agent->isDesktop()){
	    	$dis='Desktop';
	    }else if($agent->isMobile()){
	    	$dis='Mobile';
	    }else if($agent->isTablet()){
	    	$dis='Table';
	    }
	    $device = $agent->device();
	    $platform = $agent->platform();
	    $versionP = $agent->version($platform);
	    $browser = $agent->browser();
	    $versionB = $agent->version($browser);
	    $json= json_encode(array('dis' => $dis, 'device' => $device, 'platform' => $platform.' '.$versionP, 'browser' => $browser.' '.$versionB, 'latitud' => $request->latitud, 'longitud' => $request->longitud, 'recetaInfo' => array('surtio_completo' =>$request->surtioC, 'porcentaje' => '%'.$request->porcentaje, 'descripcion' => $request->descripcion)));
		return $json;
	}
}
