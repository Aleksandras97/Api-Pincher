<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {

        $posts = Post::all();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return PostResource
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'body' => 'required|max:255'
        ]);

        $post = auth()->user()->posts()->create($request->all());

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function show($post)
    {
        if (Post::find($post) == null)
        {
            return response()->json(['error' => 'Record not found'], 404);
        }

        return new PostResource(Post::findOrFail($post));
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
     * @param Request $request
     * @param Post $post
     * @return PostResource
     * @throws AuthorizationException
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'body' => 'required|max:255'
        ]);

        $post->update($request->all());

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $deleted = $post->delete();

        if ($deleted){
            return response()->json(['message' => 'Post deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Post delete failed'], 404);
        }
    }
}
