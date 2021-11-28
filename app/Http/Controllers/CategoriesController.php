<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Categories;
use App\Http\Requests\AddCategoryRequest;
class CategoriesController extends Controller
{

    public function getCategories(){
        $categories = Categories::all();
//        $categories = app('db')->select("SELECT * FROM categories");
        return response()->json($categories);
    }

    public function addCategory(Request $request)
    {
        //validation rules
        $this->validate($request, Categories::$createRules);
        $name = $request->input('name');

//        $name = $request->getParams()->name;

        Categories::query()->insert(['name' => $name]);
        return response()->json('Success');
    }

    public function updateCategory(AddCategoryRequest $request){

        //Update in table
        $name = $request->getParams()->name;
        $id = $request->getParams()->id;

//        return response()->json($request->getParams());
        //validation
//        $validation = Validator::make($request->all(),[
//            'name' => 'required|alpha_dash|max:15|min:1',
//        ]);
//        if($validation->fails()){
//            return response()->json('Please check content of post', 400);
//        }
//        //check for same category
//        $result = app('db')->select("SELECT * FROM categories WHERE name = :name ",['name'=>$name]);
//        $count = count($result);
//        if($count >= 1){
//            return response()->json('Bad', 400);
//        }

//        app('db')->update("UPDATE categories SET name = :name WHERE id = :id", ['name' => $name, 'id' => $id]);
        Categories::where('id', $id)->update(['name' => $name]);

        return response()->json(['Success ss' => $name]);
    }

}
