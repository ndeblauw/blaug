<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

test('the welcome page lists the three most popular articles', function () {
    $author = User::factory()->create(['name' => 'Ada Author']);

    $mostPopular = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Three comments',
        'publish_date' => now()->subDays(20),
    ]);
    Comment::factory(3)->create(['article_id' => $mostPopular->id]);

    $secondMostPopular = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Two comments',
        'publish_date' => now()->subDays(21),
    ]);
    Comment::factory(2)->create(['article_id' => $secondMostPopular->id]);

    $thirdMostPopular = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'One comment',
        'publish_date' => now()->subDays(22),
    ]);
    Comment::factory(1)->create(['article_id' => $thirdMostPopular->id]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'An article without comments',
        'publish_date' => now()->subDays(23),
    ]);

    Article::factory(5)->create([
        'author_id' => $author->id,
        'publish_date' => now()->subDay(),
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSeeInOrder(['Three comments', 'Two comments', 'One comment'])
        ->assertSee('3 comments')
        ->assertDontSee('An article without comments');
});

test('the welcome page lists the five most recent articles', function () {
    $author = User::factory()->create();

    $titles = [
        'Newest article' => now()->subHour(),
        'Second newest article' => now()->subDay(),
        'Third newest article' => now()->subDays(2),
        'Fourth newest article' => now()->subDays(3),
        'Fifth newest article' => now()->subDays(4),
        'Oldest article' => now()->subDays(5),
    ];

    foreach ($titles as $title => $publishDate) {
        Article::factory()->create([
            'author_id' => $author->id,
            'title' => $title,
            'publish_date' => $publishDate,
        ]);
    }

    $this->get('/')
        ->assertOk()
        ->assertSeeInOrder([
            'Newest article',
            'Second newest article',
            'Third newest article',
            'Fourth newest article',
            'Fifth newest article',
        ])
        ->assertDontSee('Oldest article');
});

test('the welcome page reflects article and comment changes immediately', function () {
    $author = User::factory()->create(['name' => 'Ada Author']);
    $article = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Original title',
        'publish_date' => now(),
    ]);

    $this->get('/')
        ->assertSee('Original title')
        ->assertSee('0 comments');

    $article->update(['title' => 'Updated title']);

    Comment::factory()->create([
        'article_id' => $article->id,
        'user_id' => User::factory()->create(['name' => 'Alice Active'])->id,
    ]);

    $this->get('/')
        ->assertSee('Updated title')
        ->assertDontSee('Original title')
        ->assertSee('1 comment');
});

test('the welcome page lists the five most active users', function () {
    $author = User::factory()->create(['name' => 'Article Author']);
    $article = Article::factory()->create(['author_id' => $author->id]);

    $commentCounts = [
        'Alice Active' => 6,
        'Bob Busy' => 5,
        'Carol Chatty' => 4,
        'Dave Diligent' => 3,
        'Eve Engaged' => 2,
        'Frank Fringe' => 1,
    ];

    foreach ($commentCounts as $name => $commentCount) {
        $user = User::factory()->create(['name' => $name]);

        Comment::factory($commentCount)->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
        ]);
    }

    $this->get('/')
        ->assertOk()
        ->assertSeeInOrder([
            'Alice Active',
            'Bob Busy',
            'Carol Chatty',
            'Dave Diligent',
            'Eve Engaged',
        ])
        ->assertSee('6 comments')
        ->assertDontSee('Frank Fringe');
});
