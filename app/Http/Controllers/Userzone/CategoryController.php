<?php

namespace App\Http\Controllers\Userzone;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('userzone.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('userzone.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('userzone.categories.index');
    }

}
