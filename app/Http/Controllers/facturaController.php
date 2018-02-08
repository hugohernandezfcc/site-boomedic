<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Quotation;
use Auth;
use App\User;
use App\medical_appointment;
use App\professional_information;

use App\Http\Controllers\Controller;

class facturaController extends Controller
{
	public function fac(){
	    $user = user::find(Auth::id());
       	$join = DB::table('medical_appointments')->where('medical_appointments.user',Auth::id())
        	->join('users', 'medical_appointments.user_doctor', '=', 'users.id')
        	->join('professional_information', 'medical_appointments.user_doctor', '=', 'professional_information.user')
        	->join('labor_information', 'medical_appointments.workplace', '=', 'labor_information.id')
        	->select('medical_appointments.*', 'users.name', 'users.email', 'users.occupation', 'users.profile_photo', 'professional_information.specialty', 'labor_information.workplace', 'labor_information.delegation','labor_information.latitude','labor_information.longitude','labor_information.general_amount', 'labor_information.postalcode')
        	->get();
        //$professional_inf= DB::table('professional_information')->where('user',Auth::id())->get();
    	return view('factura',['join' => $join, 'user' => $user]);
	}

    public function qualification(Request $request,$id){
        $qua = medical_appointment::find($id);
        $professional_information_doctor = professional_information::find($qua->user_doctor);
        if($request->qualification != 0){
            if($qua->qualification != null){
                $professional_information_doctor->qualification_points -= $qua->qualification;
            }
            $professional_information_doctor->qualification_points -= $request->qualification;
            $qua->qualification = $request->qualification;
            $professional_information_doctor->save();
            $qua->save();
            return 'guardado';
        }else{
            if($request->qualification == 0){
                return 'Calificar del 1 al 5 que le pareció la cita médica';
            }
        }
    }
}
