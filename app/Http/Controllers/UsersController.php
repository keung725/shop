<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use Response;
use DB;
use Request;
use Auth;

class UsersController extends Controller
{

    public function register()
    {
        $inputData = Input::all();

        $rules = array(
            'email'     =>  'required|email|unique:users',
            'password'  =>  'required|min:6|confirmed',
        );
        $validator = Validator::make($inputData,$rules);
        if($validator->fails())
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        else {

            //save to DB user details

            $create = User::create([
                'email' => Input::get('email'),
                'password' => bcrypt(Input::get('password')),
            ]);

            //when create a user, it will attach a member role
            $user = User::find($create->id);
            $role = Role::where('name', '=', 'member')->firstOrFail();
            $user->roles()->attach($role->id);

            Auth::login($user);

            //return success  message
            return Response::json(['success' => true, 'message'=>  '成功註冊!']);

        }
    }

    public function login()
    {
        $email = Input::get('email');
        $password = Input::get('password');
        $remember = (Input::has('remember')) ? true : false;

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            //return success  message
            return Response::json(['success' => true, 'message'=>  '成功登入!']);
        }
        else {
            return Response::json(['success' => false, 'errors' => '電子郵件或密碼錯誤!']);
        }


    }

    public function profile(){

        return view('member.profile');

    }

}
