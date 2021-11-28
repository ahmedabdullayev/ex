<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;

use Anik\Form\FormRequest;
use App\Http\Controllers\Controller;

class AddCategoryRequest extends Controller
{
    public function __construct(Request $request)
    {
        $this->validate(
            $request, [
                'name' => 'required|alpha_dash|max:15|min:1|unique:categories,name',
            ]
        );

        parent::__construct($request);
    }
}
