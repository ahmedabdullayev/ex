<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PostsController
{
    public function createPost(Request $request){
        $content = $request->input('content');

        app('db')->insert("INSERT INTO posts (content) VALUES (:content)", ['name' => $content]);

    }
    public function check($request){
        $validation = Validator::make($request->all(),[
            'content' => 'required|max:15|min:2',
            'category_id' => 'required'
        ]);
        if($validation->fails()){
            return response()->json('Please check content of post', 400);
        }
    }
}
