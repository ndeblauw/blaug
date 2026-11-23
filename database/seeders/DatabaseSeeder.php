<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'nico@deblauwe.be',
        ]);
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $users = User::factory(75)->create()->push($admin, $testUser);

        $articles = collect(range(1, 100))
            ->map(fn () => Article::factory()->create([
                'author_id' => $users->random()->id,
            ]));

        Comment::factory(175)
            ->state(fn () => [
                'article_id' => $articles->random()->id,
                'user_id' => $users->random()->id,
            ])
            ->create();

        Comment::factory(25)
            ->unapproved()
            ->state(fn () => [
                'article_id' => $articles->random()->id,
                'user_id' => $users->random()->id,
            ])
            ->create();

        Category::factory(5)->create();
        foreach ($articles as $article) {
            $subset = Category::inRandomOrder()->take(rand(0, 5))->pluck('id')->toArray();
            $article->categories()->attach($subset);
        }
    }
}
