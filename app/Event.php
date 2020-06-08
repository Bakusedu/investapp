<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function programme()
    {
        return $this->belongsTo('App\Programme', 'programme_id', 'id');
    }
}
