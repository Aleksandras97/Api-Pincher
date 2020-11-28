<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function following()
    {
        $following = auth()->user()->follows;
        return UserResource::collection($following);
//        return $following;
    }

    public function index()
    {
        $posts =  auth()->user()->timeline();

        return PostResource::collection($posts);
    }

    public function store(User $user)
    {

//        dd('heello');
        return auth()->user()->toggleFollow($user);
    }

    public function isFollowing(User $user)
    {
        return auth()->user()->following($user);
    }
}
