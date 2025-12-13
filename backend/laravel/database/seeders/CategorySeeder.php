<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        $categories = [
            ['name' => 'Movies', 'slug' => 'movies'],
            ['name' => 'Sports', 'slug' => 'sports'],
            ['name' => 'Baking', 'slug' => 'baking'],
            ['name' => 'Painting', 'slug' => 'painting'],
            ['name' => 'Reading', 'slug' => 'reading'],
        ];

        foreach ($categories as $category){
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
