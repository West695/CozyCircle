<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $users = User::all();
        $posts = Post::all();

        if ($posts->isEmpty() || $users->isEmpty()) {
            return;
        }

        foreach ($posts as $post) {
            $count = rand(0, 5);
            for ($i = 0; $i < $count; $i++) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'content' => $faker->sentences(rand(1,3), true),
                ]);
            }
        }
    }
}
