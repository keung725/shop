<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditFormRequest;
use App\User;
use App\Role;
use DB;
use Response;

class UsersController extends Controller
{


    public function index()
    {
        $users = User::with('roles')->get();
        return $users;
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = array();

        foreach(Role::all()  as $role) {

            $roleArr = [
                'id' => $role->id,
                'name' => $role->name,
                'display_name' =>$role->display_name,
                'description' => $role->description,
                'created_at' => $role->created_at->toDateTimeString(),
                'updated_at' => $role->updated_at->toDateTimeString()
            ];

            // $roleArr  = $role->toArray() if displaying all non-hidden fields

            if($user->roles->contains('id',$role->id))  {
                $roleArr['selected'] = true;
            }else{
                $roleArr['selected'] = false;
            }

            $roles[] = $roleArr;
        }

        return Response::json(array_merge($user->toArray(),['roles'=>$roles]));
    }


}
