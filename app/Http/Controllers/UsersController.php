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

        $niceNames = array(
            'email' => '電子郵件',
            'password' => '密碼'
        );

        $validator = Validator::make($inputData,$rules);
        $validator->setAttributeNames($niceNames);

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
        $remember = Input::has('remember');


        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            //return success  message
            return Response::json(['success' => true, 'message'=>  '成功登入!']);
        }
        else {
            return Response::json(['success' => false, 'errors' => '電子郵件或密碼錯誤!']);
        }


    }

    public function profile(){
        $user = Auth::user();
        $user = User::whereId($user->id)->firstOrFail();
        return view('member.profile', compact('user'));

    }

    public function postProfile(){
        $inputData = Input::all();
        $user = Auth::user();

        $rules = array(
            'email'     =>  'required|email|Unique:users,email,'.$user->id ,
        );

        $niceNames = array(
            'email' => '電子郵件'
        );

        $validator = Validator::make($inputData,$rules);

        $validator->setAttributeNames($niceNames);

        if($validator->fails())
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        else {

            $user = User::whereId($user->id)->firstOrFail();
            if(Input::get('name') == '') {
                $user->name = null;
            }else {
                $user->name = Input::get('name');
            }
            $user->email = Input::get('email');
            $user->save();

            //return success  message
            return Response::json(['success' => true, 'message'=>  '成功更新!']);

        }
    }

    public function forgot(){
        return view('member.forgot');
    }



}
