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
use App\Models\User;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => true
    ];
});

$factory->state(User::class, 'admin', function(Faker\Generator $faker){
    return[
        'role'=>User::ADMIN,
    ];
});

$factory->state(User::class, 'client', function(Faker\Generator $faker){
    return[
        'role'=>User::CLIENT,
    ];
});


$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(App\Models\Serie::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'description'=>$faker->sentence(16),
        'thumb'=>'thumb.jpg'
    ];
});

$factory->define(App\Models\Video::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'description'=>$faker->sentence(16),
        'duration'=>rand(1,30),
        'thumb'=>'thumb_video.jpg',
        'file'=>'file.jpg',
        'published'=>rand(0,1),
        'completed'=>1,
    ];
});