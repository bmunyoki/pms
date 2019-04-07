<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Doctor;
use App\Models\Visit;

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
                'url' => "/doctor/appointments"
            ]);
        } else {
            return array([
                'success' => 0,
                'message' => 'Error creating doctor. Refresh browser and try again'
            ]);
        }
    }

    public function getNewAppointmentsPage(){
        $apps = Visit::where('doctor_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        return view('doc.new', [
            'title' => "PMS::New Appointments",
            'apps' => $apps
        ]);
    }

    public function attendToAppointmentPage(Request $request){
        $appId = $request->segment(4);
        $app = Visit::where('id', $appId)->first();

        return view('doc.attend', [
            'title' => "PMS::Attend to Appointment",
            'app' => $app
        ]);
    }

    public function attendToAppointment(Request $request){
        $status = 1;
        if($request->input('send') == 'Yes'){
            $status = 2;
        }

        if (Visit::where('id', $request->input('id'))->update([
            'status' => $status,
            'symptoms' => $request->input('symptoms'),
            'lab' => $request->input('lab'),
            'diagnosis' => $request->input('diagnosis'),
            'prescription' => $request->input('prescription'),
        ])) {
            return array([
                'success' => 1,
                'message' => 'Appointment saved successly! Redirecting new appointments ...'
            ]);
        }else{
            return array([
                'success' => 0,
                'message' => 'Error saving details'
            ]);
        }
    }
}
