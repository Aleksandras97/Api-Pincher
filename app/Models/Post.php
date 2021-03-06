<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

//    protected $casts = [
//        'body' => 'string',
//        'user_id' => 'integer',
//    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); //Comment has post_id
    }

    public  function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
