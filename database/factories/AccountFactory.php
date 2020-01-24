<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Account;
use App\AccountPassword;
use App\Enums\AccountExpansion;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Account::class, function (Faker $faker) {
    return [
        // 'id',
        'username' => $username = $faker->userName,
        'sha_pass_hash' => AccountPassword::make('password', $username),
        'email' => $email = $faker->safeEmail,
        'reg_mail' => $email,
        'joindate' => now(),
        'last_ip' => '127.0.0.1',
        'last_attempt_ip' => '127.0.0.1',
        'failed_logins' => 0,
        'locked' => false,
        'lock_country' => '00',
        'last_login' => now(),
        'online' => false,
        'expansion' => AccountExpansion::getRandomValue(),
        'mutetime' => '0',
        'mutereason' => '',
        'muteby' => '',
        'os' => '',
        'vp' => '0',
        'dp' => '0'
    ];
});
