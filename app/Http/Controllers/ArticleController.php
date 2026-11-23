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

        // Additionally only load relevant columns
        // $articles = Article::select('id','title','author_id')->get();
        // $articles->load('author:id,name','media','categories:id,name');

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
