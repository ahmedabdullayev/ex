<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;
class PostsController extends Controller
{
    public function createPost(Request $request){
        //validate
        $this->validate($request, Posts::$createRules);

        $content = $request->input('content');
        $categories_id = $request->input('categories_id');

        $insert = Posts::query()->insert(["content" => $content, "categories_id" => $categories_id]);
        if($insert) {
            return response()->json('Success');
        }
       return response()->json('Bad insert', 402);
    }
    public function getPostsByCategory($category){
        $postsG = Categories::with('posts')->where('name', $category)->get();
        return response()->json($postsG[0]['posts']);
    }
    public function deletePost($id){
        $delete = Posts::where('id', $id)->delete();
        if($delete){
            return response()->json('Success');
        }
        return response()->json('Delete problem',400);
    }

}
