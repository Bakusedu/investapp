<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    protected $fillable = ['title', 'description', 'slug', 'user_id','forum_id'];
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    public function forum()
    {
        return $this->belongsTo('App\Forum', 'forum_id', 'id');
    }
}
