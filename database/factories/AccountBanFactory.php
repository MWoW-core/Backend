<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use App\AccountBan;
use Faker\Generator as Faker;

$factory->define(AccountBan::class, function (Faker $faker) {
    return [
        'id' => factory(Account::class),
        'bandate' => now()->unix(),
        'unbandate' => '0',
        'bannedby' => $faker->userName,
        'banreason' => $faker->bs,
        'active' => true
    ];
});
