<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use Validator;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;
use Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $create = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        //when create a user, it will attach a member role
        $user = User::find($create->id);
        $role = Role::where('name', '=', 'member')->firstOrFail();
        $user->roles()->attach($role->id);

        return $create;
    }


    public function redirectToFacebook()
    {
        return Socialite::with('facebook')->redirect();
    }

    public function getFacebookCallback()
    {

        $data = Socialite::with('facebook')->user();
        $user = User::where('email', $data->email)->first();

        if(!is_null($user)) {
            Auth::login($user);
            $user->facebook_id = $data->id;

            $user->save();
        } else {
            $user = User::where('facebook_id', $data->id)->first();
            if(is_null($user)){
                // Create a new user
                $user = new User();
                $user->email = $data->email;
                $user->facebook_id = $data->id;
                $user->save();
            }

            Auth::login($user);
        }


        return redirect('/')->with('success', 'Successfully logged in!');


    }


}
