<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    $gender = $faker->randomElement(['Male', 'Female']);
    return [
        'name' => $faker->name,
        'birthday' => $faker->dateTimeBetween($startDate = '1970-01-01 00:00:00', $endDate = '2015-12-30 23:59:59', $timezone = null),
        'sex'        =>  $gender,
        'email'        =>  $faker->freeEmail,
        'phone'        =>  $faker->phoneNumber,
        'address'        =>  $faker->address,
        'image'        =>  'DefaultAvatar.png',
        'info'              =>$faker->realText($maxNbChars = 100, $indexSize = 2) ,
        'note'              =>$faker->realText($maxNbChars = 150, $indexSize = 2) ,
        'created_at'        => $faker->dateTimeBetween($startDate = '2017-01-01 00:00:00', $endDate = '2020-12-30 23:59:59', $timezone = null),
        'updated_at'        => $faker->dateTimeBetween($startDate = '2019-01-01 00:00:00', $endDate = '2019-12-30 23:59:59', $timezone = null),
    ];
});
