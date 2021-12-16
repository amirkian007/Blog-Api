<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response($posts, 201);
    }

    public function store(StorePostRequest $request, Post $post)
    {
        $post->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
        ]);

        $response = array(
            'post' => $post
        );

        return response($response, 201);
    }

    public function show(Post $post)
    {
        return response($post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
        ]);

        $response = array(
            'post' => $post
        );

        return response($response, 201);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return [
            'message' => 'this post deleted sucess!'
        ];
    }
}
