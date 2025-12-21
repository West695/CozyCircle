<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create Image option
        $images = [
            'general' => [null],
            'movies' => ['img/movies/movie_1', 'img/movies/movie_2', null],
            'sports' => ['img/sports/sport_1', 'img/sports/sport_2', null],
            'baking' => ['img/baking/bake_1', 'img/baking/bake_2', null],
            'painting' => ['img/painting/paint_1', 'img/painting/paint_2', null],
            'reading' => ['img/reading/book_1', 'img/reading/book_2', null],
        ];

        // Categories Keywords
        $categoryKeywords = [
            'movies' => 'Movie of the week: ',
            'sports' => 'Weekend exercise! ',
            'baking' => 'Try out this baking recipe.',
            'painting' => 'The hidden gem of art',
            'reading' => 'Must-read book (imo) is '
        ];

        $categories = Category::all();
        $users = User::all();

        // Create 5 post each categories (total= 25 post)
        foreach ($categories as $category){
            // fallback in case category is not found
            $keyword = $categoryKeywords[$category->slug] ?? '';

            for ($i=0; $i<5; $i++){
                Post::create([
                    'content' => $keyword . $faker->text(rand(150, 250)),
                    'image' => $faker->randomElement($images[$category->slug]),
                    'category_id' => $category->id,
                    'user_id' => $users->random()->id,
                ]);
            }
        }
    }
}
