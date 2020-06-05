<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use Auth;
use App\Forum;
use App\ForumCategory;
class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with('categories')->get();
        $categories = ForumCategory::all();
        $posts = Post::paginate(10);
        return view('forum.index', compact('forums','posts', 'categories'));
    }

    public function topics()
    {
       return view('forum.topics');
    }

    public function singlePost($slug)
    {
        $categories = ForumCategory::all();
        $posts = Post::paginate(10);
        $post = Post::whereSlug($slug)->with('user')->first();

      return view('forum.singlepost', compact('posts','post','categories'));
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => Auth::user()->first_name. ' '. Auth::user()->last_name,
            'slug' => Str::of($request->title)->slug('-').Str::uuid(),
            'user_id' => Auth::user()->id,
            'forum_category_id' => $request->categoryId,
        ]);

        return redirect()->route('forum.post', ['slug'=>$post->slug]);
    }
}
