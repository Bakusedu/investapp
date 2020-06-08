<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WaitingList extends Model
{
    protected $fillable = ['username', 'user_id', 'programme_id','programme_title','email','phone','status'];
}
