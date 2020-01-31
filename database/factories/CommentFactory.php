<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->bs,
        'commentable_type' => $type = $faker->randomElement(['News']),
        'commentable_id' => factory("App\\{$type}"),
        'user_id' => factory(User::class),
        'is_approved' => true
    ];
});
