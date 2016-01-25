<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use Response;
use DB;
use Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $roles = Role::all();
        $selectedRoles = $user->roles->lists('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'selectedRoles'));
    }

    public function update($id)
    {

        $input = Input::all();

        $rules = array();

        $validator = Validator::make($input, $rules);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        }
        else {
            $user = User::whereId($id)->firstOrFail();
            if(Input::get('name') == '') {
                $user->name = null;
            }else {
                $user->name = Input::get('name');
            }
            $user->save();
            $user->saveRoles(Input::get('role'));


            return Response::json(['success' => true, 'message'=>  'The user has been updated!']);
        }
    }
}
