<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function dashboard()
    {
        $programme = Auth::user()->programmes()->latest()->with('events')->first();
        return view('users/dashboard', compact('programme'));
    }
}
