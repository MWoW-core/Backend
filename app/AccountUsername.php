<?php

namespace App;

use Illuminate\Support\Str;

class AccountUsername
{
    public static function make(string $username)
    {
        return Str::upper($username);
    }
}
