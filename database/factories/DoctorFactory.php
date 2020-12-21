<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Doctor;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    return [
        'name' => $faker->name,
        'major' => 'Teeth Bracing',
        'birthday' => $faker->dateTimeBetween($startDate = '1970-01-01 00:00:00', $endDate = '1995-12-30 23:59:59', $timezone = null),
        'sex'        =>  $gender,
        'email'        =>  $faker->freeEmail,
        'phone'        =>  $faker->phoneNumber,
        'address'        =>  $faker->address,
        'image'        =>  'DefaultAvatar.png',
        'created_at'        => $faker->dateTimeBetween($startDate = '2017-01-01 00:00:00', $endDate = '2020-12-30 23:59:59', $timezone = null),
        'updated_at'        => $faker->dateTimeBetween($startDate = '2019-01-01 00:00:00', $endDate = '2019-12-30 23:59:59', $timezone = null),
    ];
});
