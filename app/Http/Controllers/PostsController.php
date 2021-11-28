<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Posts;
use Illuminate\Support\Facades\Validator;
class PostsController
{
    public function createPost(Request $request){
        $content = $request->input('content');
        $categories_id = $request->input('categories_id');

        $validation = Validator::make($request->all(),[
            'content' => 'required|max:140|min:2',
            'categories_id' => 'required'
        ]);
        if($validation->fails()){
            return response()->json('Please check content of post', 400);
        }
        $insert = app('db')->insert("INSERT INTO posts (content, categories_id) VALUES (:content, :categories_id)",
            ['content' => $content, 'categories_id' => $categories_id]);

       if($insert) {
           return response()->json('Success');
       }
       return response()->json('Bad insert', 402);
    }
    public function getPostsByCategory($category){
        $postsG = Categories::with('posts')->where('name', $category)->get();
//        $postsG = Posts::query()->Categories->where('name', $category)->first();

//       $id = app('db')->select("SELECT id FROM categories WHERE name = :name", ['name' => $category]);
//       $posts = app('db')->select("SELECT * FROM posts WHERE categories_id = :id", ['id' => $id[0]->id]);
       // or use this better:
        // SELECT id,content,category_id FROM posts WHERE category_id = (SELECT id FROM categories WHERE name = "Football");
        //or this:
        //SELECT tulemus.id, tulemus.content, tulemus.category_id
        //FROM(SELECT id,content,category_id FROM posts) tulemus WHERE category_id =(SELECT id FROM categories WHERE name = "Football");
        return response()->json($postsG[0]['posts']);
    }
    public function deletePost($id){
        $delete = app('db')->delete("DELETE FROM posts WHERE id = :id", ['id'=>$id]);
        if($delete){
            return response()->json('Success');
        }
        return response()->json('Bad',400);
    }
//    public function check($request){
//        $validation = Validator::make($request->all(),[
//            'content' => 'required|max:15|min:2',
//            'category_id' => 'required'
//        ]);
//        if($validation->fails()){
//            return response()->json('Please check content of post', 400);
//        }
//    }
}
