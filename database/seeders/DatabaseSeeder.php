<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Article::factory()->count(20)->create();
        Category::factory()->count(5)->create();
        Comment::factory()->count(40)->create();

        User::factory()->create([
            "name" => "luffy",
            "email" => "luffy@gmail.com"
        ]);

        User::factory()->create([
            "name" => "kieko",
            "email" => "kieko@gmail.com"
        ]);

        User::factory()->create([
            "name" => "kaung",
            "email" => "kaung@gmail.com"
        ]);

    }
}
