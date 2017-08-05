<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;

use Auth;

class PatientController extends Controller
{
   protected $redirectTo = '/patient/login';

    public function home(Request $request){
      return View::make('patient.home');
    }
}
