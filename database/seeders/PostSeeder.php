<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()->hasComments(3)->hasUser()->count(10)->create();
        //Attaching random user to the post
        foreach (Post::all() as $post)
        {
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $post->tags()->attach($tags);
        }
    }
}
