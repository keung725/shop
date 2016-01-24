<?php

namespace App\Http\Controllers\Api;

use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;

class RolesController extends Controller
{


    public function index()
    {
        $roles = Role::all();
        return $roles;
    }

    public function edit($id)
    {
        $role = Role::whereId($id)->firstOrFail();
        return $role;
    }
}
