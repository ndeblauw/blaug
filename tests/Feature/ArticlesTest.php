<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;

test('the articles index lists the newest articles first', function () {
    $author = User::factory()->nonAdmin()->create(['name' => 'Ada Author']);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Newest article',
        'publish_date' => now(),
    ]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Middle article',
        'publish_date' => now()->subDay(),
    ]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Oldest article',
        'publish_date' => now()->subDays(2),
    ]);

    $this->get(route('articles.index'))
        ->assertOk()
        ->assertSeeInOrder(['Newest article', 'Middle article', 'Oldest article'])
        ->assertSee('Ada Author');
});

test('the article detail page shows the article content', function () {
    $author = User::factory()->nonAdmin()->create(['name' => 'Ada Author']);
    $category = Category::factory()->create(['name' => 'Unique category']);
    $content = 'A unique paragraph that only belongs to this article.';

    $article = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'A unique article title',
        'content' => $content,
    ]);

    $article->categories()->attach($category);

    $this->get(route('articles.show', $article))
        ->assertOk()
        ->assertSee('A unique article title')
        ->assertSee($content)
        ->assertSee('Ada Author')
        ->assertSee('Unique category');
});

test('the article detail page lists three related articles', function () {
    $author = User::factory()->nonAdmin()->create();

    $current = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'The current article',
        'publish_date' => now(),
    ]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'First related article',
        'publish_date' => now()->subDay(),
    ]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Second related article',
        'publish_date' => now()->subDays(2),
    ]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Third related article',
        'publish_date' => now()->subDays(3),
    ]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'An article that is not related',
        'publish_date' => now()->subDays(4),
    ]);

    $this->get(route('articles.show', $current))
        ->assertOk()
        ->assertSeeInOrder([
            'First related article',
            'Second related article',
            'Third related article',
        ])
        ->assertDontSee('An article that is not related');
});
