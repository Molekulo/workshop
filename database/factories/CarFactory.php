<?php

use Faker\Generator as Faker;

$factory->define(App\Car::class, function (Faker $faker) {
    return [
        'plate' => $faker->unique()->numberBetween(10000000-99999999),
        'mark' => $faker->name,
        'model' => $faker->name,
        'year' => $faker->year,
        'kilometers' => $faker->numberBetween(0, 99999),
        'engine_volume' => $faker->numberBetween(500, 8000),
        'horse_power' => $faker->numberBetween(30, 1000),
        'user_id' => 2
    ];
});
