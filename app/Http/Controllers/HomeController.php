<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use Response;
use DB;

use App\HomeBanner;
use Session;

class HomeController extends Controller
{

    public function home(Request $request)
    {
        $HomeBanners = DB::table('home_banners')->where('status', 1)->where('show', 1)->orderBy('ordering', 'asc')->get();
        return view('home', compact('HomeBanners'));
    }

}
