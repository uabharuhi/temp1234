<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Class needed for login and Logout logic
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;

use Auth;

class DoctorController extends Controller
{
   protected $redirectTo = '/doctor/login';

    public function home(Request $request){
      return View::make('doctor.home');
    }
}
