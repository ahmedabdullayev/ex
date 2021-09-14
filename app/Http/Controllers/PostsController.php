<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PostsController
{
    public function createPost(Request $request){
        $content = $request->input('content');
        $category_id = $request->input('category_id');

        $validation = Validator::make($request->all(),[
            'content' => 'required|max:140|min:2',
            'category_id' => 'required'
        ]);
        if($validation->fails()){
            return response()->json('Please check content of post', 400);
        }
        $insert = app('db')->insert("INSERT INTO posts (content, category_id) VALUES (:content, :category_id)",
            ['content' => $content, 'category_id' => $category_id]);

       if($insert) {
           return response()->json('Success');
       }
       return response()->json('Bad insert', 402);
    }
    public function getPostsByCategory($category){
       $id = app('db')->select("SELECT id FROM categories WHERE name = :name", ['name' => $category]);
       $posts = app('db')->select("SELECT * FROM posts WHERE category_id = :id", ['id' => $id[0]->id]);
        return response()->json($posts);
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
