<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recipe_test extends Model
{
    protected $table = 'recipes_tests';
    protected $fillable = ['type', 'doctor', 'patient', 'notes', 'folio', 'date', 'Data_frontend',];

    public function user(){
	  return $this->belongsTo('App\User', 'user');
	}
}
