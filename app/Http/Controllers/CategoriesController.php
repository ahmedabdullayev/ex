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
        $this->check($request);
        //Put in table
        $name = $request->input('name');
        app('db')->insert("INSERT INTO categories (name) VALUES (:name)", ['name' => $name]);
       // DB::insert("INSERT INTO categories (name) VALUES ('$name')");

        return response()->json('Success');
    }

    public function updateCategory(Request $request){
        //Validation
        $this->check($request);
        //Update in table
        $name = $request->input('name');
        $id = $request->input('id');
        app('db')->update("UPDATE categories SET name = :name WHERE id = :id", ['name' => $name, 'id' => $id]);

        return response()->json(['Success ss' => $name]);
    }
    public function check($request){
        $validation = Validator::make($request->all(),[
            'name' => 'required|alpha_dash|max:15|min:1|unique:categories',
        ]);
        if($validation->fails()){
            return response()->json('Please check name of category', 400);
        }
    }
}
