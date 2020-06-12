<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = ['name', 'email','title','organization','facebook','twitter','linkedIn','image',
    'invite_accepted', 'invited', 'programme_id', 'invite_id'];
    public function programme()
    {
        return $this->belongsTo('App\Programme', 'programme_id', 'id');
    }
}
