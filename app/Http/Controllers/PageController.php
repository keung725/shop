<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Response;
use DB;
use Session;

class PageController extends Controller
{

    public function home()
    {
        $HomeBanners = DB::table('home_banners')->where('status', 1)->where('show', 1)->orderBy('ordering', 'asc')->get();

        $Categories = DB::table('categories')->where('status', 1)->where('show', 1)->where('favor', 1)->whereNull('parent_id')->orderBy('ordering', 'asc')->get();

        $levelTwoCategories = DB::table('categories')->where('status', 1)->where('show', 1)->where('favor', 1)->whereNotNull('parent_id')->orderBy('ordering', 'asc')->get();

        return view('home', compact('HomeBanners', 'Categories', 'levelTwoCategories'));
    }

}
