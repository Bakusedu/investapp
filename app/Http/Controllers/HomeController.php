<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use App\Comment;
use App\Forum;
use App\ForumCategory;
use App\User;
use App\Programme;
use App\Event;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        $users = User::count();
        $topics = Post::count();
        $events = Event::count();
        $prog = Programme::count();
        return view('home', compact('posts', 'users','topics','prog','events'));
    }
}
