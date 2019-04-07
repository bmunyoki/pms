<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Visit;

class LabController extends Controller{
    // Get waiting page
    public function getWaitingPage(){
    	$apps = Visit::where('status', 2)->get();

    	return view('lab.waiting', [
            'title' => "PMS::Lab Patients",
            'apps' => $apps
        ]);
    }

    // Get one
    public function getSingle(Request $request){
    	$appId = $request->segment(3);
    	$app = Visit::where('id', $appId)->first();

    	return view('lab.attend', [
            'title' => "PMS::Lab Attend to Appointment",
            'app' => $app
        ]);
    }

    // Attend to appointment
    public function attendToAppointment(Request $request){
    	if (Visit::where('id', $request->input('id'))->update([
    		'status' => 4,
    		'lab' => $request->input('lab')
    	])) {
    		return array([
                'success' => 1,
                'message' => 'Lab details save successfully'
            ]);
    	} else {
    		return array([
                'success' => 0,
                'message' => 'Error saving lab details'
            ]);
    	}
    	
    }
}
