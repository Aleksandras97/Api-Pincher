<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index()
    {
//        return PostResource::collection(Post::all());
        return Post::with('comments')->get();
    }

    public function show($id)
    {
        return Post::with('comments')->get()->where('id', $id);
    }

    public function showComments($id){
        return Post::find($id)->comments;
    }

    public function store(Request $request)
    {
//        dd($request);
        return Post::create($request->all());
    }

    public function update(Request $request, $id)
    {
        return Post::find($id)->update($request->all());
    }

    public function destroy($id)
    {
        return Post::destroy($id);
    }
}
