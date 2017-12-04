<?php

use Faker\Generator as Faker;
use App\User;
use App\Topic;
use Carbon\Carbon;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'creator'=>factory(User::class)->create()->first()->id
        ,'topic'=>factory(Topic::class)->create()->first()->id
        ,'title'=>$faker->text(100)
        ,'body'=>$faker->text(100)
        ,'ttl'=> Carbon::now()->addHour(1)
    ];
});
