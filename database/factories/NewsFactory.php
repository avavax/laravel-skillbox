<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\News;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'slug' => $faker->unique()->slug,
        'title' => $faker->sentence(5),
        'content' => $faker->paragraphs(3, true),
    ];
});
