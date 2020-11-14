<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function showLogenInUser()
    {
        $user = auth()->user();
        return new UserResource($user);
    }
}
