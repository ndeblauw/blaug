<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()
            ->with(['author', 'media', 'categories'])
            ->withCount('comments')
            ->orderByDesc('publish_date')
            ->get();

        return view('articles.index', compact('articles'));
    }

    public function show(int $id)
    {
        $article = Article::findOrFail($id);

        $relatedArticles = Article::query()
            ->with(['author', 'media', 'categories'])
            ->whereKeyNot($article->id)
            ->orderByDesc('publish_date')
            ->take(3)
            ->get();

        return view('articles.show', [
            'article' => $article,
            'comments' => $article->visibleCommentsFor(auth()->user()),
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
