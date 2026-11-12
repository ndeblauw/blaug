<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::all();

        return view('articles.index', compact('articles'));
    }

    public function show(int $id)
    {
        $article = \App\Models\Article::find($id);

        return view('articles.show', compact('article'));

    }
}
