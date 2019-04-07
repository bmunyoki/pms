<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model{
    //User - visitor (the visiting patient)
    public function visitor(){
    	return $this->belongsTo('App\User', 'patient_id');
    }

    //User - attender (Doctor who attended to a patient on a particular visit)
    public function attender(){
    	return $this->belongsTo('App\User', 'doctor_id');
    }
}
