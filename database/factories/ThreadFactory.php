<?php

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

$factory->define(App\Models\Thread::class, function (Faker $faker) {
    return [
        'channel_id' => function () {
            return factory(\App\Models\Channel::class)->create()->getKey();
        },
        'user_id' => function () {
            return factory(\App\Models\User::class)->create()->getKey();
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});
