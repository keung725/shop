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
        return view('admin.homebanner.index', compact('HomeBanners'));
    }

    public function availableIndex()
    {
        $HomeBanners = HomeBanner::all()->where('status', 1);
        return $HomeBanners;
    }

    public function recoverIndex()
    {
        $HomeBanners = HomeBanner::all()->where('status', 4);
        return $HomeBanners;
    }

    public function recoverView()
    {
        $HomeBanners = HomeBanner::all()->where('status', 4);
        return view('admin.homebanner.recover', compact('HomeBanners'));
    }

    public function store(){
        $input = Input::all();

        $file = Input::file('image');
        $rules = array(
            'image' => 'required|image',
            'title' => 'required',
            'link_path' => 'required',
        );

        $niceNames = array(
            'image' => 'Home Banner',
            'title' => 'Title',
            'link_path' => 'Link Path',
        );

        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($niceNames);
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
                'link_path' => Input::get('link_path'),
                'title' => Input::get('title'),
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

    public function edit($id)
    {
        $HomeBanner = HomeBanner::whereId($id)->firstOrFail();
        return view('admin.homebanner.edit', compact('HomeBanner'));
    }

    public function update($id) {

        $input = Input::all();

        $rules = array(
            'image' => 'image',
        );

        $niceNames = array(
            'image' => 'Home Banner',`      `
        );

        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($niceNames);
        if ( $validator->fails() ){
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        }else {

            $HomeBanner = HomeBanner::find($id);

            if (Input::has('show')) {
                $HomeBanner->show = Input::get('show');
            }
            if (Input::has('ordering')) {
                $HomeBanner->ordering = Input::get('ordering');
            }
            if (Input::has('status')) {
                $HomeBanner->status = Input::get('status');
            }
            if (Input::has('link_path')) {
                $HomeBanner->link_path = Input::get('link_path');
            }
            if (Input::has('title')) {
                $HomeBanner->title = Input::get('title');
            }

            if (Input::hasfile('image')) {
                $file = Input::file('image');

                $destinationPath = 'uploads/banners/';
                $filename = $file->getClientOriginalName();
                Input::file('image')->move($destinationPath, $filename);

                $ext = substr($filename, strrpos($filename, "."));
                $newFileName = basename($filename, $ext) . "_" . $HomeBanner->id . "_" . date("Ymdhis") . $ext;

                rename($destinationPath . $filename, $destinationPath . $newFileName);

                HomeBanner::where('id', $HomeBanner->id)
                    ->update(['image_path' => $destinationPath . $newFileName]);

            }

            $HomeBanner->save();

            if (Input::hasfile('image')) {
                return Response::json(['success' => true, 'message' => 'Home Banner has been updated!', 'file' => asset($destinationPath . $newFileName)]);
            } else {
                return Response::json(['success' => true, 'message' => 'Home Banner has been updated!']);
            }
        }
    }
}
