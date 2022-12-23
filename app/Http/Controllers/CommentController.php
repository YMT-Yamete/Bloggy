<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', '=', $id)->get();
        return view('post.comment', compact('post', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $postID)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        if (Auth::id()) {
            Comment::create([
                'text' => $request->comment,
                'post_id' => $postID,
                'user_id' => Auth::id()
            ]);
            return back();
        } else {
            echo ("<script LANGUAGE='JavaScript'>
                window.alert('You need to login first');
                window.location.href='/login';
                </script>");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id, $comment_id)
    {
    }

    public function denyComment(Request $request, $post_id, $comment_id)
    {
        $comment = Comment::find($comment_id);
        $comment->update([
            'status' => "Denied",
        ]);
        return redirect('/posts/' . $post_id . '/comments')->with('msg', 'A comment has been denied');
    }
}
