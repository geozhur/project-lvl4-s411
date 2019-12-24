<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(10),
        'description' => $faker->text(),
        'status_id' => App\TaskStatus::all()->random()->id,
        'assigned_to_id' => App\User::all()->random()->id,
        'creator_id' => App\User::all()->random()->id
    ];
});
