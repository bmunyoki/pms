<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model{
    // Belongs to a user
    public function user(){
    	return $this->belongsTo('App\User');
    }

    
}
