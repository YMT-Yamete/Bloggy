<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::select('posts.id', 'posts.title', 'posts.category_id', 'posts->content')
        //         ->join('users', 'users.')
        //         ->where()
        //         ->paginate(5);
        $posts = Post::where('user_id', Auth::id())->paginate(5);
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
            'content' => 'required',
            'img' => 'required',
        ]);

        if ($request->hasFile('img')) {
            $this->validate($request, [
                'img' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
            ]);

            // Save the file locally in the storage/app/public/ folder under a new folder named /blog
            $request->img->store('blog', 'public');

            Post::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'img_path' => $request->img->hashName(),
                'user_id' => Auth()->user()->id,
            ]);
            return redirect('/posts')->with('msg', 'A post has been created successfully');
        }
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
