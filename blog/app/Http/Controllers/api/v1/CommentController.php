<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, Post $post)
    {
        $comment = Comment::create([
            'body' => $request->body,
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
        ]);

        return response($comment, 201);
    }

    public function show(Post $post)
    {
        $comment = Comment::where('post_id', $post->id)->get();
        return response($comment, 201);
    }
}
