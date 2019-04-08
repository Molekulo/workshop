<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->realText(45),
        'duration' => '01:00',
        'cycle' => $faker->numberBetween(0, 500000)
    ];
});
