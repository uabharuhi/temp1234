<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	 protected $table = 'reservation';
	 public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id', 'hour1','hour2','date'
    ];
    # dynamic properties
	public function patient()
    {

        return $this->belongsTo('App\Patient','patient_id','id');
    }
}
