<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Auth;

class PatientController extends Controller{
    //Finish registration page
    public function getCompletePage(){
    	return view('patient.complete', [
            'title' => "PMS::Complete Registration"
        ]);
    }

    // Get create visit page
    public function getCreateVisitPage(){
        return view('patient.new-visit', [
            'title' => "PMS::New Visit"
        ]);
    }

    // COmplete registration
    public function completeReg(Request $request){
    	$doc = new Patient();
    	$doc->user_id = Auth::user()->id;
        $doc->dob = $request->input('dob');
        $doc->gender = $request->input('gender');
        $doc->save();

        if ($doc->id > 0) {
            return array([
                'success' => 1,
                'message' => 'Patient creation success! Redirecting to complete registration ...',
                'url' => "/patients/visits"
            ]);
        } else {
            return array([
                'success' => 0,
                'message' => 'Error creating patient. Refresh browser and try again'
            ]);
        }
    }
}
