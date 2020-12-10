<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image'        =>  'DefaultAvatar.png',
        'created_at'        => $faker->dateTimeBetween($startDate = '2017-01-01 00:00:00', $endDate = '2020-12-30 23:59:59', $timezone = null),
        'updated_at'        => $faker->dateTimeBetween($startDate = '2019-01-01 00:00:00', $endDate = '2019-12-30 23:59:59', $timezone = null),
    ];
});
