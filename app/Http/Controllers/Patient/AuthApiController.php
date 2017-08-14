<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\View;
use Symfony\Component\Console\Output\ConsoleOutput;
use Auth;
use Validator;

class AuthApiController extends Controller
{
  use AuthenticatesUsers; //trait
    //                                inject

    public function login(Request $request)
    {
        $output = new ConsoleOutput();
        $output->writeln('1234');
        $output->writeln($request->all());
        #直接用this validate好像會有問題
       $validator = Validator::make($request->all(), [
         'ssn' => 'required|string|max:16',
         'password'  => 'required|string|max:255'
       ]) ;
       if ($validator->fails()) {
           return response()->json($validator->errors(), 422) ;
       }
      #$output->writeln( $this->guard()->getUser() );

     # $this->validate($request,[
     #    'ssn' => 'required|string|max:16',
     #    'password'  => 'required|string|max:255'
     # ]) ;
      $credentials = $request->only(['password', 'ssn']) ;
      if ($token = $this->guard()->attempt($credentials)) {
          $output->writeln('2');
          #
          return $this->sendLoginResponse($request, $token) ;

      }
      $output->writeln('3');
      #login failed

      return  'login failed , password or ssn was wrong' ;

    }

    protected function sendLoginResponse(Request $request, string $token)
    {
      $this->clearLoginAttempts($request);

      return $this->authenticated($request, $this->guard()->user(), $token);
    }

    protected function authenticated(Request $request, $user, string $token)
    {
        return response()->json([
            'token' => $token,
        ]);
    }


    public function username()
    {
        return 'ssn';
    }


    protected function guard()
    {
        return Auth::guard('patient_api') ;
    }

#'ssn' => 'required|string|max:16|unique:patient',
#'name' => 'required|string|max:16',
#'password' => 'required|string|max:255',
    public function home(){
      #return '87';
      #return $this->guard()->getUser()->ssn;
    }
    public function logout()
    {
        $this->guard()->logout();
        // if look to  AuthenticatesUsers.logout , they clear reqeust session
        //  but in this context we need only to logout doctor part
        // if a user uses browser log as both patient and doctor
        // it may cause some problem
        return 'logout successfully' ;
    }
}
