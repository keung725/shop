<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Brand;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Response;
use DB;
use Request;

class BrandController extends Controller
{
    public function create()
    {
        return view('admin.brand.create');
    }

    public function index()
    {
        $Brands = Brand::all()->where('status', 1);
        return view('admin.brand.index', compact('Brands'));
    }

    public function availableIndex()
    {
        $Brands = Brand::all()->where('status', 1);
        return $Brands;
    }

    public function recoverIndex()
    {
        $Brands = Brand::all()->where('status', 4);
        return $Brands;
    }

    public function recoverView()
    {
        $Brands = Brand::all()->where('status', 4);
        return view('admin.brand.recover', compact('Brands'));
    }

    public function store(){
        $input = Input::all();

        $file = Input::file('image');
        $rules = array(
            'image' => 'required|image',
            'title' => 'required',
        );

        $niceNames = array(
            'image' => 'brand image',
            'title' => 'Title',
        );

        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($niceNames);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        }
        else {
            $destinationPath = 'uploads/brands/';
            $filename = $file->getClientOriginalName();
            Input::file('image')->move($destinationPath, $filename);

            $create = Brand::create([
                'show' => 0,
                'title' => Input::get('title'),
            ]);

            //when create a user, it will attach a member role
            $Brand = Brand::find($create->id);

            $ext = substr($filename, strrpos($filename, "."));
            $newFileName = basename($filename, $ext) . "_" . $Brand->id . "_" . date("Ymdhis")   . $ext;

            rename($destinationPath . $filename, $destinationPath . $newFileName);

            Brand::where('id', $Brand->id)
                ->update(['image_path' => $destinationPath . $newFileName]);

            return Response::json(['success' => true, 'message'=>  'A Brand has been created!','file' => asset($destinationPath.$filename)]);
        }
    }

    public function edit($id)
    {
        $Brand = Brand::whereId($id)->firstOrFail();
        return view('admin.brand.edit', compact('Brand'));
    }

    public function update($id) {

        $input = Input::all();

        $rules = array(
            'image' => 'image',
        );

        $niceNames = array(
            'image' => 'brand image',
        );

        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($niceNames);
        if ( $validator->fails() ){
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        }else {

            $Brand = Brand::find($id);

            if (Input::has('show')) {
                $Brand->show = Input::get('show');
            }
            if (Input::has('ordering')) {
                $Brand->ordering = Input::get('ordering');
            }
            if (Input::has('status')) {
                $Brand->status = Input::get('status');
            }
            if (Input::has('title')) {
                $Brand->title = Input::get('title');
            }

            if (Input::hasfile('image')) {
                $file = Input::file('image');

                $destinationPath = 'uploads/brands/';
                $filename = $file->getClientOriginalName();
                Input::file('image')->move($destinationPath, $filename);

                $ext = substr($filename, strrpos($filename, "."));
                $newFileName = basename($filename, $ext) . "_" . $Brand->id . "_" . date("Ymdhis") . $ext;

                rename($destinationPath . $filename, $destinationPath . $newFileName);

                Brand::where('id', $Brand->id)
                    ->update(['image_path' => $destinationPath . $newFileName]);

            }

            $Brand->save();

            if (Input::hasfile('image')) {
                return Response::json(['success' => true, 'message' => 'Brand has been updated!', 'file' => asset($destinationPath . $newFileName)]);
            } else {
                return Response::json(['success' => true, 'message' => 'Brand has been updated!']);
            }
        }
    }
}
