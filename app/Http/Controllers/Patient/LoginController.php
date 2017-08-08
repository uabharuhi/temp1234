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
   protected $redirectTo = '/patient/login';
    use AuthenticatesUsers; //trait
    //                                inject

    public function login(Request $request){
      #qwrwq


      $this->validate($request,[
         'ssn' => 'required',
         'password'  => 'required'
      ]);

      $res = Auth::guard('patient')->attempt(
        ['ssn' => $request->ssn,'password'=>$request->password]
      );

      if ($res) {
        $intended_url = Session::get('url.intended', url('/'));
        Log::debug($intended_url);
        Log::debug('Login Successful');
        return redirect()->intended('/patient/home');
      }
       Log::debug('Login GG');
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
        return redirect($this->redirectTo);
    }




}
