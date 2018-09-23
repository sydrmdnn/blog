<?php

use Faker\Generator as Faker;

$factory->define(App\Story::class, function (Faker $faker) {
    $title = $faker->sentence(5);
    return [
        'title' => $title,
        'body' => $faker->sentence(20),
        'image' => str_random(5),
        'slug' => str_slug($title),
    ];
});
