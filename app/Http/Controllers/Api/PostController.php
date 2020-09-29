<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $posts =  Post::with('comments')->with('user')->get();
//        $response = APIHelpers::createAPIResponse(false, 200, '', $posts);
        return response()->json(Post::with('comments')->with('user')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePostRequest $request)
    {
        $post = new Post();
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post_save = $post->save();
        if ($post_save){
            return $post;
        } else {
            return response()->json('Comment creation failed', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        if (Post::find($post) == null)
        {
            return response()->json(['error' => 'Record not found'], 404);
        }
        return Post::with('comments')->with('user')->find($post);

    }

    public function showComments($post){
        if (Post::find($post) == null)
        {
            return response()->json(['error' => 'Record not found'], 404);
        }
        return Post::find($post)->comments;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SavePostRequest $request, $id)
    {
        $post = Post::find($id);
        $post->body = $request->body;
        $post->user_id = $request->user_id;
        $post_save = $post->save();
        if ($post_save){
            return $post;
        } else {
            return response()->json('Comment update failed', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Post::destroy($id)){
            return response()->json(['message' => 'Comment deleted successfully'], 204);
        } else {
            return response()->json(['message' => 'Comment delete failed'], 404);
        }
    }
}
