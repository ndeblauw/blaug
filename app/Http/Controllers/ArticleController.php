<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        // Normal eager loading (avoid N+1)
        $articles = Article::get();
        $articles->load('author','media','categories');

        return view('articles.index', compact('articles'));
    }

    public function show(int $id)
    {
        $article = Article::findOrFail($id);

        return view('articles.show', [
            'article' => $article,
            'comments' => $article->visibleCommentsFor(auth()->user()),
        ]);
    }
}
