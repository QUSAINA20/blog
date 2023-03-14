<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageCommentsController extends Controller
{
    public function store(Request $request, Image $image)
    {
        $request->validate([
            'body'   => 'required',
        ]);
        $image->comments()->create(
            [
                'user_id' => $request->user()->id,
                'body' => $request->input('body')
            ]
        );
        return redirect()->route('images.show', $image);
    }

    public function destroy(Image $image, Comment $comment)
    {
        $comment->delete();
        return redirect()->route('images.show', $image->slug)->with('success', 'Comment deleted successfully');
    }
}
