<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Tag::latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag_save = $tag->save();
        if ($tag_save){
            return $tag;
        } else {
            return response()->json('Product creation failed', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($tag)
    {
        if (! Tag::find($tag))
        {
            return response()->json(['error' => 'Record not found'], 404);
        }
        return Comment::find($tag)->with('user')->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Comment::find($id);
        $tag->name = $request->name;
        $tag_save = $tag->save();
        if ($tag_save){
            return $tag;
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
        if (Tag::destroy($id)){
            return response()->json('Product deleted successfully', 200);
        } else {
            return response()->json('Product delete failed', 400);
        }
    }
}
