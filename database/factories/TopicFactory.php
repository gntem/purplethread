<?php

use Faker\Generator as Faker;

$factory->define(App\Topic::class, function (Faker $faker) {
    return [
        'title'=>$faker->unique()->word(10)
	    ,'description'=>$faker->text(150)
    ];
});
