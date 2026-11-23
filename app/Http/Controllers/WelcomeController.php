<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

class WelcomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $popularArticles = Article::query()
                ->with('author')
                ->withCount('comments')
                ->orderByDesc('comments_count')
                ->orderBy('title')
                ->take(3)
                ->get()
                ->map(fn (Article $article) => [
                    'id' => $article->id,
                    'title' => $article->title,
                    'author_name' => $article->author->name,
                    'comments_count' => $article->comments_count,
                ])
                ->all();

        $recentArticles = Article::query()
                ->with('author')
                ->orderByDesc('publish_date')
                ->take(5)
                ->get()
                ->map(fn (Article $article) => [
                    'id' => $article->id,
                    'title' => $article->title,
                    'author_name' => $article->author->name,
                    'publish_date' => $article->publish_date->format('M j, Y'),
                ])
                ->all();

        $activeUsers = User::query()
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
    
        return view('welcome', compact('popularArticles', 'recentArticles', 'activeUsers'));
    }
}
