<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use Auth;
use App\Comment;
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

    public function topics(Request $request)
    {
        $categories = ForumCategory::all();
       $category = ForumCategory::whereSlug($request->slug)->first();
       return view('forum.topics', compact('category', 'categories'));
    }

    public function singlePost($slug)
    {
        $categories = ForumCategory::all();
        $posts = Post::paginate(10);
        $post = Post::whereSlug($slug)->with('user')->first();
        $comments = Comment::wherePostId($post->id)->latest()->simplePaginate(5);

      return view('forum.singlepost', compact('posts','post','categories','comments'));
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

    public function storeComment(Request $request)
    {

        $post = Post::findOrFail($request->postId);
        $comment = $post->comments()->create([
            'title' => $request->title,
            'content' => $request->content,
            'author' => Auth::user()->first_name. ' '. Auth::user()->last_name,
            'user_id' => Auth::user()->id
        ]);
        if ($comment) {
            return response()->json($comment, 200);
        }
        return response()->json('failed', 400);
    }
}
