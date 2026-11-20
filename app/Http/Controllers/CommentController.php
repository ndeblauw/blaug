<?php

namespace App\Http\Controllers;

use App\Jobs\NewCommentToArticleAuthorJob;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        // step 0 - validation
        $validated = $request->validate([
            'content' => ['required', 'string','min:1', 'max:1000'],
        ]);

        // step 1 - load necessary data
        // step 2a - create the comment
        $comment = Comment::create([
            'article_id' => $id,
            'content' => $validated['content'],
        ]);

        Log::info('before sending the job');
        NewCommentToArticleAuthorJob::dispatch($comment);
        Log::info('after sending the job');

        // step 3 - return a response (view, redirect)
        return redirect()->back();
    }
}
