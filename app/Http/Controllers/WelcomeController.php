<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Str;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $popularArticles = cache()->flexible('popular_articles', [10, 20], function () {
            return Article::query()
                ->with(['author', 'media'])
                ->withCount('comments')
                ->orderByDesc('comments_count')
                ->orderBy('title')
                ->take(3)
                ->get()
                ->map(fn (Article $article) => [
                    'id' => $article->id,
                    'slug' => $article->slug,
                    'title' => $article->title,
                    'author_name' => $article->author->name,
                    'comments_count' => $article->comments_count,
                    'image' => $article->getImagePath('card'),
                ])
                ->all();
        });

        $recentArticles = cache()->flexible('recent_articles', [10, 20], function () {
            return Article::query()
                ->with(['author', 'categories', 'media'])
                ->orderByDesc('publish_date')
                ->take(5)
                ->get()
                ->map(fn (Article $article) => [
                    'id' => $article->id,
                    'slug' => $article->slug,
                    'title' => $article->title,
                    'author_name' => $article->author->name,
                    'author_id' => $article->author_id,
                    'publish_date' => $article->publish_date->format('M j, Y'),
                    'image' => $article->getImagePath('card'),
                    'hero_image' => $article->getImagePath('hero'),
                    'category' => $article->categories->first()?->name,
                    'excerpt' => Str::limit(strip_tags($article->content), 200),
                ])
                ->all();
        });

        $popularAuthors = cache()->flexible('popular_authors', [10, 20], function () {
            return User::query()
                ->whereHas('articles')
                ->with('media')
                ->withCount('articles')
                ->withCount([
                    'articles as comments_count' => fn ($query) => $query->join('comments', 'comments.article_id', '=', 'articles.id'),
                ])
                ->orderByDesc('comments_count')
                ->orderByDesc('articles_count')
                ->orderBy('name')
                ->take(5)
                ->get()
                ->map(fn (User $user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'avatar' => $user->getAvatarPath('thumb'),
                    'articles_count' => $user->articles_count,
                    'comments_count' => $user->comments_count,
                ])
                ->all();
        });

        $activeUsers = cache()->flexible('active_users', [10, 20], function () {
            return User::query()
                ->whereHas('comments')
                ->withCount('comments')
                ->orderByDesc('comments_count')
                ->orderBy('name')
                ->take(5)
                ->get()
                ->map(fn (User $user) => [
                    'name' => $user->name,
                    'comments_count' => $user->comments_count,
                ])
                ->all();
        });

        return view('welcome', compact('popularArticles', 'recentArticles', 'popularAuthors', 'activeUsers'));
    }
}
