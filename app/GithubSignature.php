<?php

namespace App;

class GithubSignature
{
    public static function make(string $contents): string
    {
        return 'sha1=' . hash_hmac(
                'sha1',
                $contents,
                config('services.github.deployment_secret')
            );
    }
}
