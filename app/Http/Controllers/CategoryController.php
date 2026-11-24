<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()
            ->whereHas('articles')
            ->withCount('articles')
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function show(int $id): View
    {
        $category = Category::query()
            ->whereHas('articles')
            ->findOrFail($id);

        $category->load([
            'articles' => fn ($query) => $query->withCount('comments')->orderByDesc('publish_date'),
            'articles.author',
            'articles.media',
        ]);

        return view('categories.show', compact('category'));
    }
}
