<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use Auth;

class DoctorController extends Controller{
    //Finish registration page
    public function getCompletePage(){
    	return view('doc.complete', [
            'title' => "PMS::Complete Registration"
        ]);
    }

    // COmplete registration
    public function completeReg(Request $request){
    	$doc = new Doctor();
    	$doc->user_id = Auth::user()->id;
        $doc->speciality = $request->input('speciality');
        $doc->save();

        if ($doc->id > 0) {
            return array([
                'success' => 1,
                'message' => 'Doctor creation success! Redirecting to complete registration ...',
                'url' => "/doctor/patients/waiting"
            ]);
        } else {
            return array([
                'success' => 0,
                'message' => 'Error creating doctor. Refresh browser and try again'
            ]);
        }
    }
}
