<?php

namespace App;

use Illuminate\Support\Str;

class AccountUsername
{
    public static function make(string $username): string
    {
        return Str::upper($username);
    }

    public static function rules(): array
    {
        return [
            'string', 'alpha_num', 'min:3', 'max:40'
        ];
    }
}
