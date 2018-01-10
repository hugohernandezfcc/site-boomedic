<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tributaryProfile extends Model
{
    //
    protected $table = 'tributary_profile';
    protected $fillable = ['company_legalName', 'rfc', 'country', 'state', 'delegation', 'colony', 'street','exteriorNumber', 'interiorNumber','postalCode','user'];

    public function user(){
	  return $this->belongsTo('App\User', 'user');
	}
}
