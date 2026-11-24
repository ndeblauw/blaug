<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    $author = User::factory()->nonAdmin()->create();
    $category = Category::factory()->create();

    $article = Article::factory()->create(['author_id' => $author->id]);
    $article->categories()->attach($category);

    $this->author = $author;
    $this->category = $category;
    $this->article = $article;
});

test('the welcome page is reachable', function () {
    $this->get(route('welcome'))->assertOk();
});

test('the articles index is reachable', function () {
    $this->get(route('articles.index'))->assertOk();
});

test('the article detail page is reachable', function () {
    $this->get(route('articles.show', $this->article))->assertOk();
});

test('the authors index is reachable', function () {
    $this->get(route('authors.index'))->assertOk();
});

test('the author detail page is reachable', function () {
    $this->get(route('authors.show', $this->author))->assertOk();
});

test('the categories index is reachable', function () {
    $this->get(route('categories.index'))->assertOk();
});

test('the category detail page is reachable', function () {
    $this->get(route('categories.show', $this->category))->assertOk();
});

test('the login page is reachable', function () {
    $this->get(route('login'))->assertOk();
});

test('the registration page is reachable', function () {
    $this->get(route('register'))->assertOk();
});

test('the forgot password page is reachable', function () {
    $this->get(route('password.request'))->assertOk();
});

test('the reset password page is reachable', function () {
    $this->get(route('password.reset', ['token' => 'test-token']))->assertOk();
});
