<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }
}
