<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;

class Patient extends Authenticatable  implements AuthenticatableUserContract
{
	 protected $table = 'patient';
	 public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ssn', 'password','name'
    ];
	
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	public function getJWTIdentifier()
    {
        return $this->getKey();  // Eloquent model method
    }
	
	public function getJWTCustomClaims()
    {
        return [
             'patient' => [ 
                'id' => $this->id
             ]
        ];
    }

    public function reservations(){
        return $this->hasMany('App\Reservation');
    }
}
