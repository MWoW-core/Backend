<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class AccountRegistered implements ShouldBeStored
{
    public array $attributes = [];

    /**
     * AccountRegistered constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }
}
