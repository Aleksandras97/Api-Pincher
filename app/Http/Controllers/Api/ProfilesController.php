<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        // dd(User::findOrFail($user) == null);
        // if (User::find($user) == null)
        // {
        //     return response()->json(['error' => 'Profile not found'], 404);
        // }

        return new UserResource($user);
    }

    public function update(User $user, Request $request)
    {
        $attributtes = request()->validate([
            'name' => ['string', 'required', 'max:255'],
            'email' => ['string', 'required', 'max:255', 'email', Rule::unique('users')->ignore($user)],
            'password' => ['required', 'string', 'min:6', 'max:255', 'confirmed'],
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        return new UserResource($user);
    }

    public function showLogenInUser()
    {
        $user = auth()->user();
        return new UserResource($user);
    }
}
