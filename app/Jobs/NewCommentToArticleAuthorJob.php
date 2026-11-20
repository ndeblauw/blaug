<?php

namespace App\Jobs;

use App\Notifications\NewCommentToYourArticleNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NewCommentToArticleAuthorJob implements ShouldQueue
{
    use Queueable;

    private $comment;
    private $author;

    /**
     * Create a new job instance.
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
        $this->author = $comment->article->author;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->author->notify(new NewCommentToYourArticleNotification($this->comment));
    }
}
