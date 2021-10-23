<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(App\Models\BlogPost::class, function (Faker $faker) {

    $txt = $faker->realText(rand(1000,4000));
    $title = $faker->sentence(rand(3,8), true);
    $isPublished = rand(1,5) > 1;
    return [
        'title' => $title,
        'category_id'   => rand(1,11),
        'user_id'       => (rand(1,5) == 5) ? 1 : 2,
        'slug'          => Str::slug($title),
        'excerpt'       => $faker->text(rand(40,100)),
        'content_raw'   => $txt,
        'content_html'  => $txt,
        'is_published'  => $isPublished,
        'published_at'  => $isPublished ? $faker->dateTimeBetween('-2 months', '-1 days') : null,
        'created_at'    => $faker->dateTimeBetween('-3 months', '-2 months'),
        'updated_at'    => $faker->dateTimeBetween('-3 months', '-2 months'),
    ];
});
