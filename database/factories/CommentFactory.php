<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\News;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $usersIds = User::all()->pluck('id');
    if (rand(0, 1) > 0.5) {
        $commentableType = Post::class;
        $commentableId = Post::all()->pluck('id')->random();
    } else {
        $commentableType = News::class;
        $commentableId = News::all()->pluck('id')->random();
    }

    return [
        'content' => $faker->text(),
        'author_id' => $usersIds->random(),
        'commentable_type' => $commentableType,
        'commentable_id' => $commentableId,
    ];
});
