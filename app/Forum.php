<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = ['title', 'isActive', 'description'];

    public function categories()
    {
        return $this->hasMany('App\ForumCategory');
    }
}
