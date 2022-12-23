<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required'
        ]);

        Post::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'content' => $request->content
        ]);
        return redirect('/posts')->with('msg', 'A post has been created successfully');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $post = Post::find($id);

        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        return redirect('/posts')->with('msg', 'A post has been updated successfully');
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        return back()->with('msg', 'A post has been deleted successfully');
    }

    public function showList()
    {
        $posts = Post::paginate(5);
        return view('index', compact('posts'));
    }

    
    public function showDetails($id)
    {
        $post = Post::find($id);
        return view('post.show', compact('post'));
    }
}
