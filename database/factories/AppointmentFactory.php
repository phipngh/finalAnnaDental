<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Appointment;
use Faker\Generator as Faker;


$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phonenumber' => $faker->phoneNumber,
        'date' => $faker->dateTimeBetween($startDate = '2020-12-01 00:00:00', $endDate = '2021-02-20 23:59:59', $timezone = null),
        'note' =>$faker->text
    ];
});
