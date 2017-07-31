<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //                                inject
    public function login(Request $request){
      $id_num = $request->input('id_num');
      $password = $request->input('password');
      return "ID:$id_num,pwd:$password";
    }
}
