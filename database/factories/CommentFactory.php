<?php

use Faker\Generator as Faker;
use App\User;
use App\Topic;
use App\Post;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'post'=>factory(Post::class)->create()->first()->id
		,'creator'=>factory(User::class)->create()->first()->id
		,'body'=>$faker->text(100)
    ];
});