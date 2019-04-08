<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Visit;

class AdminController extends Controller{
    //Get dashboard page
    public function getDashboardPage(){
    	$pats = Patient::get();
    	$docs = Doctor::get();
    	$visits = Visit::get();

    	return view('admin.dashboard', [
            'title' => "PMS::Admin Report",
            'pats' => $pats,
            'docs' => $docs,
            'visits' => $visits
        ]);
    }
}
