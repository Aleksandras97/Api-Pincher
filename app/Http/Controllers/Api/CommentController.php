<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CommentController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CommentResource
     */
    public function store(Request $request)
    {

        $request->validate([
            'body' => 'required',
            'post_id' => 'required'
        ]);

        $comment = auth()->user()->comments()->create([
            'body' => $request->body,
            'post_id' => $request->post_id
        ]);

        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param $comment
     * @return Response
     */
    public function show($comment)
    {

        if (! Comment::find($comment))
        {
            return response()->json(['error' => 'Record not found'], 404);
        }
        return new CommentResource(Comment::findOrFail($comment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveCommentRequest $request
     * @param Comment $comment
     * @return Response
     * @throws AuthorizationException
     */
    public function update(Request $request, Comment $comment)
    {

        $this->authorize('update', $comment);

        $request->validate([
            'body' => 'required|max:255'
        ]);

        $comment->update($request->all());

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Comment $comment
     * @return Response
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $deleted = $comment->delete();

        if ($deleted){
            return response()->json(['message' => 'Comment deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Comment delete failed'], 400);
        }
    }
}
