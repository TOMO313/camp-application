<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post, Comment $comment)
    {
        $comment->body = $request->comment;
        $comment->user_id = \Auth::id();
        $comment->post_id = $post->id;
        $comment->save();
        return redirect('/posts/'.$post->id);
    }
}
