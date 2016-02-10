<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Response;
use DB;
use Request;

class CategoryController extends Controller
{
    public function create()
    {
        $levelOnes = Category::all()->where('status', 1)->where('parent_id', null);
        return view('admin.category.create', compact('levelOnes'));
    }

    public function index()
    {
        $Categories = DB::table('categories as A')
            ->select('A.*', 'B.title as parent_title')
            ->where('A.status', 1)
            ->join('categories as B', 'B.id', '=', 'A.parent_id')
            ->get();
        return view('admin.category.index', compact('Categories'));
    }

    public function availableIndex()
    {
        $Categories = DB::table('categories as A')
            ->select('A.*', 'B.title as parent_title')
            ->where('A.status', 1)
            ->leftjoin('categories as B', 'B.id', '=', 'A.parent_id')
            ->get();
        return $Categories;
    }

    public function recoverIndex()
    {
        $Categories = Category::all()->where('status', 4);
        return $Categories;
    }

    public function recoverView()
    {
        $Categories = Category::all()->where('status', 4);
        return view('admin.category.recover', compact('Categories'));
    }

    public function store(){
        $input = Input::all();

        $file = Input::file('image');
        $rules = array(
            'image' => 'image',
            'title' => 'required',
        );

        $niceNames = array(
            'title' => 'Title',
        );

        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($niceNames);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        }
        else {

            if(Input::hasfile('image')){
                $destinationPath = 'uploads/category/';
                $filename = $file->getClientOriginalName();
                Input::file('image')->move($destinationPath, $filename);
            }

            if(Input::get('level2')!='') {
                $create = Category::create([
                    'show' => 0,
                    'title' => Input::get('title'),
                    'parent_id' => Input::get('level2'),
                ]);
            }else{
                $create = Category::create([
                    'show' => 0,
                    'title' => Input::get('title'),
                ]);
            }


            $Category = Category::find($create->id);

            if(Input::hasfile('image')) {
                $ext = substr($filename, strrpos($filename, "."));
                $newFileName = basename($filename, $ext) . "_" . $Category->id . "_" . date("Ymdhis") . $ext;

                rename($destinationPath . $filename, $destinationPath . $newFileName);

                Category::where('id', $Category->id)
                    ->update(['image_path' => $destinationPath . $newFileName]);
            }

            return Response::json(['success' => true, 'message'=>  'A Category has been created!']);
        }
    }

    public function edit($id)
    {
        $Category = Category::whereId($id)->firstOrFail();
        $levelOnes = Category::all()->where('status', 1)->where('parent_id', null);

        return view('admin.category.edit', compact('Category', 'levelOnes'));
    }

    public function update($id) {
        $Category = Category::find($id);

        $input = Input::all();

        $rules = array(
            'image' => 'image',
        );

        $niceNames = array(
            'image' => 'image',
        );

        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($niceNames);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        }
        else {

            if (Input::has('show')) {
                $Category->show = Input::get('show');
            }
            if (Input::has('ordering')) {
                $Category->ordering = Input::get('ordering');
            }
            if (Input::has('status')) {
                $Category->status = Input::get('status');
            }
            if (Input::has('title')) {
                $Category->title = Input::get('title');
            }

            if (Input::has('favor')) {
                $Category->favor = Input::get('favor');
            }

            if (Input::has('level2')) {
                if (Input::get('level2') != '') {
                    $Category->parent_id = Input::get('level2');
                } else {
                    $Category->parent_id = null;
                }
            }

            if (Input::hasfile('image')) {
                $file = Input::file('image');

                $destinationPath = 'uploads/category/';
                $filename = $file->getClientOriginalName();
                Input::file('image')->move($destinationPath, $filename);

                $ext = substr($filename, strrpos($filename, "."));
                $newFileName = basename($filename, $ext) . "_" . $Category->id . "_" . date("Ymdhis") . $ext;

                rename($destinationPath . $filename, $destinationPath . $newFileName);

                Category::where('id', $Category->id)
                    ->update(['image_path' => $destinationPath . $newFileName]);

            }

            $Category->save();

            if (Input::hasfile('image')) {
                return Response::json(['success' => true, 'message' => 'Category has been updated!', 'file' => asset($destinationPath . $newFileName)]);
            } else {
                return Response::json(['success' => true, 'message' => 'Category has been updated!']);
            }
        }
    }
}
