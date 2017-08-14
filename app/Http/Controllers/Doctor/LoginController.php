<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;

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


      $res = Auth::guard('doctor')->attempt(
        ['ssn' => $request->ssn,'password'=>$request->password]
      );

      if ($res) {
        return redirect()->intended('/doctor/home');
      }
      #login failed
      $request->session()->flash('login_failed', 'login failed, ssn/password wrong!');

      return redirect()->back()->withInput($request->only('ssn'));

    }

    public function showLoginForm(){
      return View::make('doctor.doctor_login');
    }


    public function username()
    {
        return 'ssn';
    }

    protected function guard()
    {
        return Auth::guard('doctor');
    }

    public function logout()
    {
        Auth::guard('doctor')->logout();
        // if look to  AuthenticatesUsers.logout , they clear reqeust session
        //  but in this context we need only to logout doctor part
        // if a user uses browser log as both patient and doctor
        // it may cause some problem
        return redirect('/doctor/login');
    }




}
