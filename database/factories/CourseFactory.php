<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Course;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Course::class, function (Faker $faker) {
    return [
        'course_name' => $faker->word,
        'course_code' => $faker->slug,
        'college'     => $faker->randomElement(['BSIT', 'CBA', 'HRM']),
        'course_type' => $faker->randomElement(['general', 'major', 'professional', 'free', 'core']),
        'is_academic' => $faker->randomElement(array(true,false)),
        'units'       => $faker->randomDigit,
    ];
});
