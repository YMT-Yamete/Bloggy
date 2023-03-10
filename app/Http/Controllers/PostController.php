<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;
use App\Models\React;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->q)) {
            $posts = Post::query()
                ->where('title', 'LIKE', "%{$request->q}%")
                ->where('user_id', Auth::id())
                ->paginate(5);
        } else {
            $posts = Post::where('user_id', Auth::id())->paginate(5);
        }
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

    public function showList(Request $request)
    {
        if (isset($request->category_ids)) {
            $posts = Post::whereIn('category_id', $request->category_ids)->paginate(5);
            $categories = Category::all();
        } else {
            $posts = Post::paginate(5);
            $categories = Category::all();
        }
        return view('index', compact('posts', 'categories'));
    }


    public function showDetails($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', '=', $id)->where('status', '=', 'Approved')->get();
        $likes = React::where('react', '=', 'Like')->get();
        $dislikes = React::where('react', '=', 'Dislike')->get();
        if (Auth::check()) {
            $reacted = React::where('user_id', '=', Auth()->user()->id)->first();
        }
        if (isset($reacted)) {
            $reactedReaction = $reacted->react;
        } else {
            $reactedReaction = null;
        }
        return view('post.show', compact('post', 'comments', 'likes', 'dislikes', 'reactedReaction'));
    }
}
