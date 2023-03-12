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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $validation = $request->validate([
            'body'   => 'required',
        ]);

        $comment->update($validation);
        return redirect()->route('posts.show', $comment->post);
    }


    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }
}
