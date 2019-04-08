<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

use Auth;

class SettingsController extends Controller{
    // Get settings page
    public function getSettingsPage(){
    	$user = User::where('id', Auth::user()->id)->first();

    	return view('patient.settings', [
            'title' => "PMS::Settings",
            'user' => $user
        ]);
    }

    // Get change password page
    public function getChangePasswordPage(){
    	return view('patient.password', [
            'title' => "PMS::Settings - Change Password"
        ]);
    }

    // Update password
    public function changePassword(Request $request){
    	if (User::where('id', Auth::user()->id)->update([
    		'password' => Hash::make($request->input('pass'))
    	])) {
    		return array([
                'success' => 1,
                'message' => 'Your password has been updated. You will be logged out now ...'
            ]);
    	} else {
    		return array([
                'success' => 0,
                'message' => 'Error updating password. Refresh browser and try again'
            ]);
    	}
    	
    }

    // Update Settings
    public function update(Request $request){
    	if (User::where('id', Auth::user()->id)->update([
    		'name' => $request->input('name'),
    		'email' => $request->input('email')
    	])) {
    		Patient::where('user_id', Auth::user()->id)->update([
    			'gender' => $request->input('gender'),
    			'dob' => $request->input('dob')
    		]);
    		return array([
                'success' => 1,
                'message' => 'Profile update success!'
            ]);

    	} else {
    		return array([
                'success' => 0,
                'message' => 'Error updating profile. Refresh browser and try again'
            ]);
    	}
    	
    }
}
