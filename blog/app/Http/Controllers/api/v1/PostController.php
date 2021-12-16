<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response($posts, 201);
    }

    public function show()
    {
    }

    public function store(StorePostRequest $request)
    {
    }

    public function update(UpdatePostRequest $request)
    {
    }

    public function destroy($id)
    {
    }
}
