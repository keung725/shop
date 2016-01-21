<?php

namespace App\Http\Controllers\Admin;


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
    public function create()
    {
        return view('admin.homebanner.create');
    }

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

    public function listView()
    {
        return view('admin.homebanner.index', compact('HomeBanners'));
    }

    public function recoverView()
    {
        return view('admin.homebanner.recover', compact('HomeBanners'));
    }

    public function update($id) {
        $HomeBanner = HomeBanner::find($id);
        $HomeBanner->show = Request::input('show');
        $HomeBanner->ordering = Request::input('ordering');
        $HomeBanner->status = Request::input('status');
        $HomeBanner->save();

        return $HomeBanner;
    }

    public function recoverUpdate($id) {
        $HomeBanner = HomeBanner::find($id);
        $HomeBanner->show = Request::input('show');
        $HomeBanner->ordering = Request::input('ordering');
        $HomeBanner->status = Request::input('status');
        $HomeBanner->save();

        return $HomeBanner;
    }

    public function store(){
        $file = Input::file('image');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'required|image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        }
        else {
            $destinationPath = 'uploads/banners/';
            $filename = $file->getClientOriginalName();
            Input::file('image')->move($destinationPath, $filename);

            $create = HomeBanner::create([
                'show' => 0,
            ]);

            //when create a user, it will attach a member role
            $HomeBanner = HomeBanner::find($create->id);

            $ext = substr($filename, strrpos($filename, "."));
            $newFileName = basename($filename, $ext) . "_" . $HomeBanner->id . "_" . date("Ymdhis")   . $ext;

            rename($destinationPath . $filename, $destinationPath . $newFileName);

            HomeBanner::where('id', $HomeBanner->id)
                ->update(['image_path' => $destinationPath . $newFileName]);

            return Response::json(['success' => true, 'message'=>  'A Home Banner has been created!','file' => asset($destinationPath.$filename)]);
        }
    }
}
