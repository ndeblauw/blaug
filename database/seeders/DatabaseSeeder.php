<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Real English category names.
     *
     * @var list<string>
     */
    private const CATEGORIES = [
        'Laravel',
        'PHP',
        'JavaScript',
        'Frontend',
        'Backend',
        'DevOps',
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userImages = $this->seedingImages('users');
        $articleImages = $this->seedingImages('articles');

        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'nico@deblauwe.be',
        ]);
        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $users = User::factory(75)->create()->push($admin, $testUser);

        $users->values()->each(function (User $user, int $index) use ($userImages) {
            $this->attachImage($user, $userImages, $index, 'avatars');
        });

        $categories = collect(self::CATEGORIES)
            ->map(fn (string $name) => Category::factory()->create(['name' => $name]));

        $articles = collect(range(1, 100))
            ->map(function (int $index) use ($users, $articleImages) {
                $article = Article::factory()->create([
                    'author_id' => $users->random()->id,
                ]);

                $this->attachImage($article, $articleImages, $index - 1, 'headers');

                return $article;
            });

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

        foreach ($articles as $article) {
            $article->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')
            );
        }
    }

    /**
     * Attach a seeding image to a model, cycling through the available files.
     *
     * @param  list<string>  $images
     */
    private function attachImage(Model $model, array $images, int $index, string $collection): void
    {
        if ($images === []) {
            return;
        }

        $model
            ->addMedia($images[$index % count($images)])
            ->preservingOriginal()
            ->toMediaCollection($collection);
    }

    /**
     * Get the full paths of the seeding images in the given directory.
     *
     * @return list<string>
     */
    private function seedingImages(string $directory): array
    {
        $path = storage_path("seedings/{$directory}");

        if (! File::isDirectory($path)) {
            return [];
        }

        return collect(File::files($path))
            ->sortBy(fn (\SplFileInfo $file) => $file->getFilename())
            ->map(fn (\SplFileInfo $file) => $file->getPathname())
            ->values()
            ->all();
    }
}
