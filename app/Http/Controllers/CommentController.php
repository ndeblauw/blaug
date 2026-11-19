<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        // step 0 - validation
        $validated = $request->validate([
            'content' => ['required', 'string','min:1', 'max:1000'],
        ]);

        // step 1 - load necessary data
        // step 2 - create the comment
        Comment::create([
            'article_id' => $id,
            'content' => $validated['content'],
        ]);

        // step 3 - return a response (view, redirect)
        return redirect()->back();
    }
}
