<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class professional_information extends Model
{
    protected $table = "professional_information";
    protected $fillable = [
		'specialty',
		'schoolOfMedicine',
		'facultyOfSpecialization',
		'practiseProfessional',
		'user',
		'professional_license'
    ];

    public function user(){
	  return $this->belongsTo('App\User', 'user');
	}
}
