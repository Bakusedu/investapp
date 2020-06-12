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

    public function creator()
    {
        return $this->belongsTo('App\User', 'createdBy', 'id');
    }

    public function speakers()
    {
        return $this->hasMany('App\Speaker');
    }

    public function waitinglist()
    {
       return $this->hasMany('App\WaitingList')->whereStatus('pending');
    }
}
