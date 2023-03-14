<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'body'   => 'required',
        ]);
        $post->comments()->create(
            [
                'user_id' => $request->user()->id,
                'body' => $request->input('body')
            ]
        );
        return redirect()->route('posts.show', $post);
    }


    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('posts.show', $post->slug)->with('success', 'Comment deleted successfully');
    }
}
