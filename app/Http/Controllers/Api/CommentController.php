<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCommentRequest $request)
    {
        //
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment_save = $comment->save();
        if ($comment_save){
            return $comment;
        } else {
            return response()->json('Product creation failed', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($comment)
    {
        //
        if (! Comment::find($comment))
        {
            return response()->json(['error' => 'Record not found'], 404);
        }
        return Comment::find($comment)->with('user')->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCommentRequest $request, $id)
    {
        $comment = Comment::find($id);
        $comment->body = $request->body;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;
        $comment_save = $comment->save();
        if ($comment_save){
            return $comment;
        } else {
            return response()->json('Product update failed', 400);
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
        if (Comment::destroy($id)){
            return response()->json('Product deleted successfully', 200);
        } else {
            return response()->json('Product delete failed', 400);
        }
    }
}
