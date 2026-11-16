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
}
