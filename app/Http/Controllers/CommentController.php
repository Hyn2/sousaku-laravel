<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:30',
        ]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
        ]);

        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Comment $comment)
    {
        if($comment->exists) {
            $comment->delete();
        }
        return Redirect::back();
    }
}
