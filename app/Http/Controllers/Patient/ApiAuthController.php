<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;
use Symfony\Component\Console\Output\ConsoleOutput;
use Validator;

class ApiAuthController extends Controller
{
    use AuthenticatesUsers;
	protected $redirectTo = '/';
	
	public function username()
	{
		return 'ssn';
	}
	
	protected function guard()
	{
		return Auth::guard('api_patient');
	}

	public function home()
    {
        $a = $this->guard()->getUser()->ssn ;
        return "Hi $a";
    }


    
	public function login(Request $request)
	{
        $output = new ConsoleOutput();
       
        $credentials = $request->only('ssn', 'password');
        $validator = Validator::make( $credentials ,[
            'ssn' => 'required|max:16',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return $validator->errors() ;
        }

		
        #$credentials = ['ssn'=>'test','password'=>'1234'];
		$output->writeln($credentials);
        #var_dump($credentials);
		if ($token = $this->guard()->attempt($credentials)) {
            
			return $this->sendLoginResponse($request, $token);
		}
       
        return $this->sendFailedLoginResponse($request);
		
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
	protected function sendFailedLoginResponse(Request $request)
	{
		return response()->json([
			'message' => 'gg failed login',
		], 401);
	}

    public function logout()
    {
        $this->guard()->logout(); 
    }
}
