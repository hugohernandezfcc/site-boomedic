<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;

class recetaController extends Controller
{
    //
    public function index(){
	    $user=DB::table('users')->get();
	    return view('receta',['receta'=>$user]);
	}
    public function show($folio){
    	/*$cont=0;
    	if(strlen($folio)==13){*/
		    $recipe=DB::table('recipes_tests')->where('folio',$folio)->get();//where('folio',"like","{$folio}%")->get();
		/*}else{
			if(count($recipe)>0){
				for($i=0;$i<count($recipe);$i++){
					if($recipe[$i]->folio==$folio){
						$cont++;
					}
				}
				if($count>1){*/
					$doctor=DB::table('users')->where('id',$recipe[0]->doctor)->get();
			    	$patient=DB::table('users')->where('id',$recipe[0]->patient)->get();
			    	$medicines=DB::table('cli_recipes_tests')->where('cli_recipes_tests.recipe_test',$recipe[0]->id)
			    		->join('medicines', 'cli_recipes_tests.medicine', '=', 'medicines.id')
			    		->get();
			    	return response()->json(['recipe'=>$recipe,'doctor'=>$doctor,'patient'=>$patient,'medicines'=>$medicines]);
				/*}
			}
		}*/

		//return response()->json(['recipe'=>$recipe,'doctor'=>$doctor,'patient'=>$patient,'medicines'=>$medicines]);
	}
	public function prueba(Request $request){
		/*if($request->ajax()){'name','LIKE',"%{$search}%"
         $dato=$request->input('hola'); //Aqui obtienes el valor del input ajax

          return Response::json($dato);
     }*/
	    //$user=DB::table('users')->get();
	    //echo "console.log('');";
	    //$nombre = $this->input->post('hola');
	    /*echo "<script>";
    	echo "console.log(".$request->hola.");";
    	//echo "console.log('Holaaaaa');";
    	echo "</script>";
    	//return response()->json($request);*/
	    return $request->folio;
	}

}
