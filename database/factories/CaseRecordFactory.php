<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CaseRecord;
use Faker\Generator as Faker;

$factory->define(CaseRecord::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'doctor_id'        =>  $faker->numberBetween($min = 6, $max = 15),
        'patient_id'        =>  $faker->numberBetween($min = 7, $max = 10),
        'created_at'        => $faker->dateTimeBetween($startDate = '2017-01-01 00:00:00', $endDate = '2020-12-31 23:59:59', $timezone = null),
        'updated_at'        => $faker->dateTimeBetween($startDate = '2019-01-01 00:00:00', $endDate = '2019-12-30 23:59:59', $timezone = null),
    ];
});
