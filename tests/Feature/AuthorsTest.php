<?php

use App\Models\Article;
use App\Models\User;

test('the authors index lists only users that have articles', function () {
    $author = User::factory()->nonAdmin()->create(['name' => 'Ada Author']);
    User::factory()->nonAdmin()->create(['name' => 'Rita Reader']);

    Article::factory()->create(['author_id' => $author->id]);

    $this->get(route('authors.index'))
        ->assertOk()
        ->assertSee('Ada Author')
        ->assertDontSee('Rita Reader');
});

test('the author detail page lists the articles of that author', function () {
    $author = User::factory()->nonAdmin()->create(['name' => 'Ada Author']);
    $otherAuthor = User::factory()->nonAdmin()->create(['name' => 'Bob Builder']);

    Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'An article by Ada',
    ]);

    Article::factory()->create([
        'author_id' => $otherAuthor->id,
        'title' => 'An article by Bob',
    ]);

    $this->get(route('authors.show', $author))
        ->assertOk()
        ->assertSee('Ada Author')
        ->assertSee('An article by Ada')
        ->assertDontSee('An article by Bob');
});
