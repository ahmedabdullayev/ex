<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    public function addCategory(Request $request)
    {
        $name = $request->input('name');
        $this->validate($request,[
            'name' => 'required',
        ]);

        return response()->json($request);
    }
}
