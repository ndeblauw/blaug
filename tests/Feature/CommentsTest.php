<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

test('guests only see approved comments', function () {
    $article = Article::factory()->create([
        'author_id' => User::factory()->nonAdmin()->create()->id,
    ]);

    Comment::factory()->create([
        'article_id' => $article->id,
        'user_id' => User::factory()->nonAdmin()->create()->id,
        'content' => 'An approved comment',
    ]);

    Comment::factory()->unapproved()->create([
        'article_id' => $article->id,
        'user_id' => User::factory()->nonAdmin()->create()->id,
        'content' => 'A hidden waiting comment',
    ]);

    $this->get(route('articles.show', $article))
        ->assertOk()
        ->assertSee('An approved comment')
        ->assertDontSee('A hidden waiting comment');
});

test('the comment author sees their own unapproved comment', function () {
    $article = Article::factory()->create([
        'author_id' => User::factory()->nonAdmin()->create()->id,
    ]);

    $commenter = User::factory()->nonAdmin()->create();

    Comment::factory()->unapproved()->create([
        'article_id' => $article->id,
        'user_id' => $commenter->id,
        'content' => 'My own waiting comment',
    ]);

    $this->actingAs($commenter)
        ->get(route('articles.show', $article))
        ->assertOk()
        ->assertSee('My own waiting comment')
        ->assertSee("This comment is awaiting validation. You're the only one to see it.", false);
});

test('the article author sees the awaiting validation badge', function () {
    $author = User::factory()->nonAdmin()->create();
    $article = Article::factory()->create(['author_id' => $author->id]);

    Comment::factory()->unapproved()->create([
        'article_id' => $article->id,
        'user_id' => User::factory()->nonAdmin()->create()->id,
        'content' => 'A comment waiting for the author',
    ]);

    $this->actingAs($author)
        ->get(route('articles.show', $article))
        ->assertOk()
        ->assertSee('A comment waiting for the author')
        ->assertSee('Awaiting validation');
});
