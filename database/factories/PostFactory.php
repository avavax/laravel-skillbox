<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Tag;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {

    $usersIds = User::all()->pluck('id');

    return [
        'slug' => $faker->unique()->slug,
        'title' => $faker->sentence(5),
        'description' => $faker->paragraph,
        'content' => $faker->paragraphs(5, true),
        'author_id' => $usersIds->random(),
        'publication' => true,
    ];
});
