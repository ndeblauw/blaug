<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

test('guests are redirected from the userzone', function () {
    $urls = [
        '/dashboard',
        '/profile',
        '/user/articles',
        '/user/comments',
        '/user/categories',
    ];

    foreach ($urls as $url) {
        $this->get($url)->assertRedirect('/login');
    }
});

test('an authenticated user can open the userzone pages', function () {
    $admin = User::factory()->admin()->create();
    $article = Article::factory()->create(['author_id' => $admin->id]);
    $category = Category::factory()->create();
    $comment = Comment::factory()->unapproved()->create([
        'article_id' => $article->id,
        'user_id' => $admin->id,
    ]);

    $urls = [
        '/dashboard',
        '/profile',
        '/user/articles',
        '/user/articles/create',
        "/user/articles/{$article->id}/edit",
        '/user/comments',
        "/user/comments/{$comment->id}",
        "/user/comments/{$comment->id}/edit",
        '/user/categories',
        '/user/categories/create',
        "/user/categories/{$category->id}/edit",
    ];

    $this->actingAs($admin);

    foreach ($urls as $url) {
        $this->get($url)->assertOk();
    }
});
