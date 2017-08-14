<?php

namespace App\Http\Controllers\Patient;

use App\Patient;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/patient/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();



        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        # $request->session()->flash('register_failed', "$ssn   has exist , use anohter!");
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function showRegistrationForm()
    {
        return view('patient.register');
    }

    protected function guard()
    {
        return Auth::guard('patient');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'ssn' => 'required|string|max:16|unique:patient',
            'name' => 'required|string|max:16',
            'password' => 'required|string|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Patient::create([
            'name' => $data['name'],
            'ssn' => $data['ssn'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
