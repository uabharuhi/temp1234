<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;

class Patient extends Authenticatable
                      implements AuthenticatableUserContract
{
	protected $table = 'patient';
	public $timestamps = false;
      protected $fillable = [
        'name', 'ssn', 'password',
    ];


    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();  // Eloquent model method
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
             'patient' => [
                'ssn' => $this->ssn,
                'name'=>$this->name,
             ]
        ];
    }

}
