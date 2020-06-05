<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\ForumCategory;
use App\Forum;
use Session;
use Auth;
class ForumCategoryController extends Controller
{
    public function allCategories()
    {
        $forums = Forum::all();
        $categories = ForumCategory::paginate(10);
        return view('admin.forum.categories.index', compact('categories', 'forums'));
    }

    public function saveCategory(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'forumId' => 'required|exists:forums,id',
        ]);
         $category =new ForumCategory();
         $category->title = $request->title;
         $category->description = $request->desc;
         $category->user_id = Auth::user()->id;
         $category->slug = Str::of($request->title)->slug('-').Str::uuid();
         $category->forum_id = $request->forumId;
         $category->save();

         Session::flash('success', 'Category created Successfully');
        return redirect()->back();
    }

    public function saveForum(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required|max:500',
        ]);
         $category =new Forum();
         $category->title = $request->title;
         $category->description = $request->desc;
         $category->slug = Str::of($request->title)->slug('-').Str::uuid();
         $category->save();
         Session::flash('success', 'Forum Created Successfully');
        return redirect()->back();
    }

}
