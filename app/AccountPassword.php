<?php

namespace App;

use App\StorableEvents\AccountPasswordChanged;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

class AccountPassword
{
    public static function make(string $password, string $username): string
    {
        return Hash::driver('sha1')->make($password, ['name' => $username]);
    }

    public static function update(string $password, Account $account)
    {
        Event::dispatch(
            new AccountPasswordChanged(
                $account->id,
                encrypt($password)
            )
        );
    }
}
