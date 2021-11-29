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
        //validation rules with this variant
        $this->validate($request, Categories::$createRules);
        $name = $request->input('name');

        Categories::query()->insert(['name' => $name]);
        return response()->json('Success');
    }

    //validation rules with Request variant : AddCategoryRequest
    public function updateCategory(AddCategoryRequest $request){
        //Update in table
        $name = $request->getParams()->name;
        $id = $request->getParams()->id;

        Categories::where('id', $id)->update(['name' => $name]);
        return response()->json(['Success' => $name]);
    }

}
