<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['author', 'title', 'slug', 'forum_category_id','user_id', 'content'];

    public function forum()
    {
        return $this->belongsTo('App\ForumCategory', 'forum_category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}



