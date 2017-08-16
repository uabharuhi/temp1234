<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers; //trait
    //                                inject

    public function login(Request $request){



      $this->validate($request,[
         'ssn' => 'required',
         'password'  => 'required'
      ]);

      $res = Auth::guard('patient')->attempt(
        ['ssn' => $request->ssn,'password'=>$request->password]
      );

      if ($res) {
        $intended_url = Session::get('url.intended', url('/'));

        return redirect()->intended('/patient/home');
      }

      #login failed
      $request->session()->flash('login_failed', ' patient .. login failed, ssn/password wrong!');

      return redirect()->back()->withInput($request->only('ssn'));

    }

    public function showLoginForm(){
      return View::make('patient.patient_login');
    }


    public function username()
    {
        return 'ssn';
    }

    protected function guard()
    {
        return Auth::guard('patient');
    }

    public function logout()
    {
        Auth::guard('patient')->logout();
        // if look to  AuthenticatesUsers.logout , they clear reqeust session
        //  but in this context we need only to logout doctor part
        // if a user uses browser log as both patient and doctor
        // it may cause some problem
        return redirect('/patient/login');
    }




}
