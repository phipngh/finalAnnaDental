<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subcrible;
use Faker\Generator as Faker;

$factory->define(Subcrible::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'created_at'        => $faker->dateTimeBetween($startDate = '2019-01-01 00:00:00', $endDate = '2019-12-30 23:59:59', $timezone = null),
        'updated_at'        => $faker->dateTimeBetween($startDate = '2019-01-01 00:00:00', $endDate = '2019-12-30 23:59:59', $timezone = null),
    ];
});
