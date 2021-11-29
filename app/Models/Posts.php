<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public static $createRules = [
        'content' => 'required|max:140|min:2'
    ];
    //
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
