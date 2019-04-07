<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $type = Auth::user()->type;
            $url = "/patients/appointments";

            if($type == 'Doctor'){
                $url = "/doctor/appointments";
            }else if($type == 'Lab'){
                $url = "/lab/waiting";
            }if($type == 'Admin'){
                $url = "/admin/reports";
            }

            return array([
                'success'=>1, 
                'url'=> $url
            ]);
        }else{
            return array([
                'success'=>0, 
                'message' => 'Invalid email and/or password'
            ]);
        }
    }

    public function getLoginPage(){
        if(Auth::check()){
            Auth::logout();
        }
    
        return view('auth.login', [
            'title' => "Asgard::Login"
        ]);
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
        }
        return redirect('/login');
    }
}
