<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

    public function getCategories(){
        $categories = app('db')->select("SELECT * FROM categories");
        return response()->json($categories);
    }
    public function addCategory(Request $request)
    {
        //Validation
        //Put in table
        $name = $request->input('name');
        //validation
        $validation = Validator::make($request->all(),[
            'name' => 'required|alpha_dash|max:15|min:1',
        ]);
        if($validation->fails()){
            return response()->json('Please check content of post', 400);
        }
        //check for same category
        $result = app('db')->select("SELECT * FROM categories WHERE name = :name ",['name'=>$name]);
        $count = count($result);
        if($count >= 1){
            return response()->json('Bad', 400);
        }
        app('db')->insert("INSERT INTO categories (name) VALUES (:name)", ['name' => $name]);

        return response()->json('Success');
    }

    public function updateCategory(Request $request){

        //Update in table
        $name = $request->input('name');
        $id = $request->input('id');
        //validation
        $validation = Validator::make($request->all(),[
            'name' => 'required|alpha_dash|max:15|min:1',
        ]);
        if($validation->fails()){
            return response()->json('Please check content of post', 400);
        }
        //check for same category
        $result = app('db')->select("SELECT * FROM categories WHERE name = :name ",['name'=>$name]);
        $count = count($result);
        if($count >= 1){
            return response()->json('Bad', 400);
        }

        app('db')->update("UPDATE categories SET name = :name WHERE id = :id", ['name' => $name, 'id' => $id]);

        return response()->json(['Success ss' => $name]);
    }

}
