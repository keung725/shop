<?php

namespace App\Http\Controllers\Api;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\HomeBanner;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Response;
use DB;
use Request;

class HomeBannerController extends Controller
{

    public function index()
    {
        $HomeBanners = HomeBanner::all()->where('status', 1);
        return $HomeBanners;
    }

    public function recoverIndex()
    {
        $HomeBanners = HomeBanner::all()->where('status', 4);
        return $HomeBanners;
    }

    public function showBanners()
    {
        $HomeBanners = HomeBanner::all()->where('status', 1)->where('show', 1);
        return $HomeBanners;
    }

    public function update($id) {
        $HomeBanner = HomeBanner::find($id);
        $HomeBanner->show = Request::input('show');
        $HomeBanner->ordering = Request::input('ordering');
        $HomeBanner->status = Request::input('status');
        $HomeBanner->save();

        return $HomeBanner;
    }

}
