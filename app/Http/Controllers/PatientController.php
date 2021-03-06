<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Visit;
use App\User;
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
        $doctors = User::where('type', 'Doctor')->get();
        return view('patient.new-visit', [
            'title' => "PMS::New Visit",
            'doctors' => $doctors
        ]);
    }

    // Get a single Appointment
    public function singleAppointment(Request $request){
        $id = $request->segment(3);
        $app = Visit::where('id', $id)->first();
        return view('patient.single', [
            'title' => "PMS::My Appointments",
            'app' => $app
        ]);
    }

    // Get edit appointment page
    public function getEditAppointment(Request $request){
        $id = $request->segment(3);
        $app = Visit::where('id', $id)->first();
        $doctors = User::where('type', 'Doctor')->get();

        return view('patient.edit-appointment', [
            'title' => "PMS::Edit Appointment",
            'app' => $app,
            'docs' => $doctors
        ]);
    }

    // Update appointment
    public function updateAppointment(Request $request){
        $id = $request->input('id');

        if (Visit::where('id', $id)->update([
            'doctor_id' => $request->input('doc'),
            'dt' => $request->input('dt')
        ])) {
            return array([
                'success' => 1,
                'message' => 'Appointment updated. Redirecting to appointments'
            ]);
        } else {
            return array([
                'success' => 0,
                'message' => 'Error updating appointment.'
            ]);
        }
    }

    // Delete an appointment
    public function deleteAppointment(Request $request){
        $id = $request->segment(3);

        if (Visit::where('id', $id)->delete()) {
            return redirect()->route('patient.appointments.all');
        } else {
            return redirect()->back('error', 'Error deleting appointment');
        }
        
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
                'url' => "/patients/appointments"
            ]);
        } else {
            return array([
                'success' => 0,
                'message' => 'Error creating patient. Refresh browser and try again'
            ]);
        }
    }

    // Create appointment
    public function createAppointment(Request $request){
        $visit = new Visit();
        $visit->patient_id = Auth::user()->id;
        $visit->doctor_id = $request->input('doc');
        $visit->dt = $request->input('dt');

        if($visit->save()){
            return array([
                'success' => 1,
                'message' => 'Appointment creation success! Redirecting to your appointments ...',
                'url' => '/patients/appointments'
            ]);
        }else{
            return array([
                'success' => 0,
                'message' => 'Error creating appointment. Refresh browser and try again'
            ]);
        }
        
    }

    // Get all appointment
    public function getAllAppointments(){
        $apps = Visit::where('patient_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('patient.appointments', [
            'title' => "PMS::My Appointments",
            'apps' => $apps
        ]);
    }
}
