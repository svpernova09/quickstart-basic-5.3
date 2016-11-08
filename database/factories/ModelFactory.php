<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Widget::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word . ' Widget',
        'description' => $faker->paragraph(3),
        'price' => $faker->randomFloat(2, 20, 999999),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Task::class, function (Faker\Generator $faker) {
    $users = App\User::all();

    return [
        'name' => $faker->sentence(4),
        'user_id' => $users->random()->id,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\MarketingEmail::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'active' => 0,
        'hash' => \Illuminate\Support\Facades\Password::getRepository()->createNewToken()
    ];
});