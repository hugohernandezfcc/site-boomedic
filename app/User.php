<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'birthdate', 
        'age',                  
        'gender',     
        'occupation', 
        'scholarship',
        'country',    
        'state',                    
        'delegation',               
        'colony',                   
        'street',                   
        'phone',                    
        'status',                   
        'username',                 
        'firstname',                
        'lastname',                 
        'placebirth',               
        'birthdate',                
        'maritalstatus',            
        'streetnumber',             
        'interiornumber',           
        'officephone',              
        'familydoctor',             
        'mobile',                      
        'reasonforlastappointment', 
        'postalcode',
        'latitude',
        'longitude',
        'profile_photo'
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
