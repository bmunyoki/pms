<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use Auth;
use App\Models\Role;
use App\Models\Company;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    
    public function register(Request $request){
        // Check if company_email is taken
        if(User::where('email', $request->input('email'))->count() > 0){
            return array([
                'success' => 0,
                'message' => 'Error creating user. The provided email is already taken'
            ]);
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->type = $request->input('role');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        if ($user->id > 0) {
            // Attach role to user
            $user_role = Role::where('name', $request->input('role'))->first();
            $user->roles()->attach($user_role);

            // Login user
            Auth::loginUsingID($user->id);

            $url = "/patient/complete";

            if($request->input('role') == 'Doctor'){
                $url = "/doctor/complete";
            }else if($request->input('role') == 'Lab'){
                $url = "/lab/waiting";
            }else if($request->input('role') == 'Admin'){
                $url = "/admin/report";
            }

            return array([
                'success' => 1,
                'message' => 'User creation success! Redirecting to complete registration ...',
                'url' => $url
            ]);
        } else {
            return array([
                'success' => 0,
                'message' => 'Error creating user. Refresh browser and try again'
            ]);
        }
        
    }

    public function getRegistrationPage(){
        if(Auth::check()){
            Auth::logout();
        }
    
        return view('auth.register', [
            'title' => "PMS::Register"
        ]);
    }
}
