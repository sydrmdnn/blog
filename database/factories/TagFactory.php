<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    $name = $faker->sentence(1);
    return [
        'name' => $name,
        'url' => str_slug($name),
        'description' => $faker->sentence(3),
    ];
});
