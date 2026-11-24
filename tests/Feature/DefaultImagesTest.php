<?php

use App\Models\Article;
use App\Models\User;

test('an article without media uses the default image', function () {
    $article = Article::factory()->create();

    expect($article->getImagePath())->toBe('/img/default-article.png');
});

test('a user without media uses the default avatar', function () {
    $user = User::factory()->nonAdmin()->create();

    expect($user->getAvatarPath())->toBe('/img/default-avatar.svg');
});
