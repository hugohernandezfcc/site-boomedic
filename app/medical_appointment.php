<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medical_appointment extends Model
{
    //
    protected $table = "medical_appointments";
    protected $fillable = [
		'id',
		'user',
		'user_doctor',
		'when',
		'status',
		'workplace',
		'qualification'
    ];

    public function user(){
	  return $this->belongsTo('App\User', 'user');
	}
}
