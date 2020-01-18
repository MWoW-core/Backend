<?php

namespace App\Hashing;

use Illuminate\Support\Str;
use Illuminate\Contracts\Hashing\Hasher;

class Sha1Hasher implements Hasher
{
    /**
     * Get information about the given hashed value.
     *
     * @param  string $hashedValue
     * @return array
     */
    public function info($hashedValue)
    {
        return [
            'algo' => 0,
            'algoName' => 'sha1',
            'options' => []
        ];
    }
    
    /**
     * Check the given plain value against a hash.
     *
     * @param  string $value
     * @param  string $hashedValue
     * @param  array $options
     * @return bool
     */
    public function check($value, $hashedValue, array $options = [])
    {
        if (strlen($hashedValue) === 0) {
            return false;
        }

        return $this->make($value, $options) === $hashedValue;
    }

    /**
     * Hash the given value.
     *
     * @param  string $value
     * @param  array $options
     * @return string
     */
    public function make($value, array $options = [])
    {
        return Str::upper(
            hash(
                'sha1', 
                Str::upper($options['name']) . ':' . Str::upper($value)
            )
        );
    }

    /**
     * Check if the given hash has been hashed using the given options.
     *
     * @param  string $hashedValue
     * @param  array $options
     * @return bool
     */
    public function needsRehash($hashedValue, array $options = [])
    {
        return false;
    }
}
