<?php

namespace App\Http\Controllers;

use App\Models\React;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactController extends Controller
{
    public function like($post_id)
    {
        $reactCount = React::where('user_id', '=', Auth()->user()->id)->where('post_id', '=', $post_id)->count();
        if ($reactCount == 0) {
            React::create([
                'user_id' => Auth()->user()->id,
                'post_id' => $post_id,
                'react' => 'Like',
            ]);
        } else {
            $likeCount = React::where('user_id', '=', Auth()->user()->id)->where('post_id', '=', $post_id)->where('react', '=', 'Like')->count();
            if($likeCount == 0) {
                React::where('user_id', '=', Auth()->user()->id)
                ->where('post_id', '=', $post_id)
                ->update([
                    'react' => 'Like',
                ]);
            }
            else {
                React::where('user_id', '=', Auth()->user()->id)->delete();
            }
        }
        return redirect('/posts/' . $post_id . '/show');
    }

    public function dislike($post_id)
    {
        $reactCount = React::where('user_id', '=', Auth()->user()->id)->where('post_id', '=', $post_id)->count();
        if ($reactCount == 0) {
            React::create([
                'user_id' => Auth()->user()->id,
                'post_id' => $post_id,
                'react' => 'Dislike',
            ]);
        } else {
            $dislikeCount = React::where('user_id', '=', Auth()->user()->id)->where('post_id', '=', $post_id)->where('react', '=', 'Dislike')->count();
            if($dislikeCount == 0) {
                React::where('user_id', '=', Auth()->user()->id)
                ->where('post_id', '=', $post_id)
                ->update([
                    'react' => 'Dislike',
                ]);
            }
            else {
                React::where('user_id', '=', Auth()->user()->id)->delete();
            }
        }
        return redirect('/posts/' . $post_id . '/show');
    }
}
