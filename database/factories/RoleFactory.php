<?php


use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\models\Role;

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

$factory->define(Role::class, function (Faker $faker) {
    $name = $faker->unique()->words(2,true);
    $desc = $faker->text;
    $slug = strtolower(str_replace(' ', '-', $name));
    return [
        'name' => $name,
        'desc' => $desc,
        'slug' => $slug,
    ];
});

