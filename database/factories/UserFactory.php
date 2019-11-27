<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'mi' => ucfirst($faker->randomLetter) . '.',
        'surname' => $faker->lastName,
        'gender' => $faker->randomElement(array('male','female')),
        'college' => $faker->randomElement(array('CCS','CBA','CHRM')),
        'department' => $faker->randomElement(array('IT','INSYS','BA')),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$4zv8LEcuZg5F6vKFxJws7.0LB6pZ9larDbVFlAq/RU9qSeYfKS6cS', // dev123
    ];
});
