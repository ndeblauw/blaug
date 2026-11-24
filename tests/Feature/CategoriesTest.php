<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;

test('the categories index lists only categories that have articles', function () {
    $category = Category::factory()->create(['name' => 'Laravel']);
    Category::factory()->create(['name' => 'React']);

    Article::factory()
        ->create(['author_id' => User::factory()->nonAdmin()->create()->id])
        ->categories()
        ->attach($category);

    $this->get(route('categories.index'))
        ->assertOk()
        ->assertSee('Laravel')
        ->assertDontSee('React');
});

test('the category detail page lists the articles of that category', function () {
    $author = User::factory()->nonAdmin()->create();

    $category = Category::factory()->create(['name' => 'Laravel']);
    $otherCategory = Category::factory()->create(['name' => 'React']);

    $article = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'An article about Laravel',
    ]);
    $article->categories()->attach($category);

    $otherArticle = Article::factory()->create([
        'author_id' => $author->id,
        'title' => 'An article about React',
    ]);
    $otherArticle->categories()->attach($otherCategory);

    $this->get(route('categories.show', $category))
        ->assertOk()
        ->assertSee('Laravel')
        ->assertSee('An article about Laravel')
        ->assertDontSee('An article about React');
});
