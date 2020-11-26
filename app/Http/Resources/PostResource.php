<?php

namespace App\Http\Resources;

use App\Http\Resources\CommentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'body' => $this->body,
            'created_at' => $this->created_at->diffForHumans(),
            'user' => [
                'username' => $this->user->username ?? '',
                'name' => $this->user->name ?? '',
                'email' => $this->user->email ?? '',
            ],
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
