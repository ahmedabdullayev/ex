<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;
class Categories extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    //but we use Requests/AddCategoryRequest
    public static $createRules = [
        'name' => 'required|alpha_dash|max:15|min:1|unique:categories,name',
    ];
    public function posts()
    {
        return $this->hasMany(Posts::class);
    }
}
