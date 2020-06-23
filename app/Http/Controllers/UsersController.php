<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Programme;
class UsersController extends Controller
{
    public function dashboard()
    {
        $programmes = Programme::latest()->paginate(6);
        $programme = Auth::user()->programmes()->latest()->with('events')->first();
        return view('users/dashboard', compact('programme', 'programmes'));
    }

    public function programmes($type)
    {

        $data = Programme::with('events')->latest()->paginate(6);
        $programme = Auth::user()->programmes()->where('createdBy', '!=', Auth::user()->id)->latest()->with('events')->paginate(6);
        if ($type == 'mine') {
            $user = Auth::user();
        $data = Programme::where("createdBy", $user->id)->latest()->with('events')->with('users')->with('waitinglist')->with('speakers')->paginate(6);
        }
        if ($type == 'attended') {
        $data = $programme;
        }

        return response()->json($data, 200);
    }

    public function Logout()
    {
        Auth::logout();
        return view("welcome");
    }
}
