<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\tributaryProfile;

class perfilTributarioController extends Controller
{
    public function edit(){
    	$user=DB::table('users')->where('id',Auth::id())->get();
        $perfil=DB::table('tributary_profile')->where('user',Auth::id())->get();
    	return view('Perfil-Tributario',['perfil'=>$perfil,'user'=>$user] );
    }

    public function update(Request $request,$id){
    	$this->validate($request, [
            'street' => 'required',
            'postalCode' => 'required',
            'delegation' => 'required',
            'country' => 'required',
            'state' => 'required',
            'rfc' => 'required',
            'company_legalName' => 'required',
        ]); 
        $tributaryProfile=DB::table('tributary_profile')->where('user',Auth::user()->id)->get();
        if(count($tributaryProfile)>0){
            $perfilT = tributaryProfile::find($tributaryProfile[0]->id);
            $perfilT->company_legalName = $request->company_legalName;
            $perfilT->rfc = $request->rfc;
            $perfilT->country = $request->country;
            $perfilT->state = $request->state;
            $perfilT->delegation = $request->delegation;
            $perfilT->colony = $request->colony;
            $perfilT->street = $request->street;
            $perfilT->exteriorNumber = $request->exteriorNumber;
            $perfilT->interiorNumber = $request->interiorNumber;
            $perfilT->postalCode = $request->postalCode;
            $perfilT->save();
        }else{
            $perfilT = new tributaryProfile($request->all());
            $perfilT->user=Auth::user()->id;
            $perfilT->save();
        }
    	return redirect('perfilTributario');
    }
}
