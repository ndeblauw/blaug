<?php

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

test('the welcome page highlights the newest article', function () {
    $author = User::factory()->nonAdmin()->create(['name' => 'Ada Author']);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'The newest dispatch',
        'publish_date' => now()->subHour(),
    ]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'An older dispatch',
        'publish_date' => now()->subDay(),
    ]);

    $this->get(route('welcome'))
        ->assertOk()
        ->assertSee('Latest dispatch')
        ->assertSee('The newest dispatch');
});

test('the welcome page links to articles using their slug', function () {
    $author = User::factory()->nonAdmin()->create();

    $article = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'A slugged dispatch',
        'slug' => 'a-slugged-dispatch',
        'publish_date' => now()->subHour(),
    ]);

    $this->get(route('welcome'))
        ->assertOk()
        ->assertSee(route('articles.show', $article->slug))
        ->assertDontSee(route('articles.show', $article->id));
});

test('the welcome page lists the next four recent articles', function () {
    $author = User::factory()->nonAdmin()->create();

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

    $this->get(route('welcome'))
        ->assertOk()
        ->assertSeeInOrder([
            'Second newest article',
            'Third newest article',
            'Fourth newest article',
            'Fifth newest article',
        ])
        ->assertDontSee('Oldest article');
});

test('the welcome page lists the five most popular authors', function () {
    $recentAuthor = User::factory()->nonAdmin()->create(['name' => 'Recent Author']);

    Article::factory(5)->create([
        'author_id' => $recentAuthor->id,
        'publish_date' => now()->subHour(),
    ]);

    $commenter = User::factory()->nonAdmin()->create(['name' => 'Commenter']);

    $commentCounts = [
        'Popular Six' => 6,
        'Popular Five' => 5,
        'Popular Four' => 4,
        'Popular Three' => 3,
        'Popular Two' => 2,
        'Popular One' => 1,
    ];

    foreach ($commentCounts as $name => $commentCount) {
        $author = User::factory()->nonAdmin()->create(['name' => $name]);

        $article = Article::factory()->create([
            'author_id' => $author->id,
            'publish_date' => now()->subMonths(2),
        ]);

        Comment::factory($commentCount)->create([
            'article_id' => $article->id,
            'user_id' => $commenter->id,
        ]);
    }

    User::factory()->nonAdmin()->create(['name' => 'Rita Reader']);

    $this->get(route('welcome'))
        ->assertOk()
        ->assertSeeInOrder([
            'Popular Six',
            'Popular Five',
            'Popular Four',
            'Popular Three',
            'Popular Two',
        ])
        ->assertDontSee('Popular One')
        ->assertDontSee('Rita Reader');
});

test('the welcome page lists the five most active readers', function () {
    $author = User::factory()->nonAdmin()->create(['name' => 'Article Author']);
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
        $user = User::factory()->nonAdmin()->create(['name' => $name]);

        Comment::factory($commentCount)->create([
            'article_id' => $article->id,
            'user_id' => $user->id,
        ]);
    }

    $this->get(route('welcome'))
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

test('the welcome page lists the three most popular articles', function () {
    $author = User::factory()->nonAdmin()->create(['name' => 'Ada Author']);
    $commenter = User::factory()->nonAdmin()->create();

    $mostPopular = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Three comments',
        'publish_date' => now()->subDays(20),
    ]);
    Comment::factory(3)->create([
        'article_id' => $mostPopular->id,
        'user_id' => $commenter->id,
    ]);

    $secondMostPopular = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'Two comments',
        'publish_date' => now()->subDays(21),
    ]);
    Comment::factory(2)->create([
        'article_id' => $secondMostPopular->id,
        'user_id' => $commenter->id,
    ]);

    $thirdMostPopular = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'One comment',
        'publish_date' => now()->subDays(22),
    ]);
    Comment::factory(1)->create([
        'article_id' => $thirdMostPopular->id,
        'user_id' => $commenter->id,
    ]);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'An article without comments',
        'publish_date' => now()->subDays(23),
    ]);

    Article::factory(5)->create([
        'author_id' => $author->id,
        'publish_date' => now()->subDay(),
    ]);

    $this->get(route('welcome'))
        ->assertOk()
        ->assertSeeInOrder(['Three comments', 'Two comments', 'One comment'])
        ->assertSee('3 comments')
        ->assertDontSee('An article without comments');
});
