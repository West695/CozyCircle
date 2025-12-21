<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'General', 'slug' => 'general', 'icon' => '📋'],
            ['name' => 'Movies', 'slug' => 'movies', 'icon' => '🎬'],
            ['name' => 'Sports', 'slug' => 'sports', 'icon' => '🏀'],
            ['name' => 'Baking', 'slug' => 'baking', 'icon' => '🍰'],
            ['name' => 'Painting', 'slug' => 'painting', 'icon' => '🎨'],
            ['name' => 'Reading', 'slug' => 'reading', 'icon' => '📚'],
        ];

        foreach ($categories as $category){
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
