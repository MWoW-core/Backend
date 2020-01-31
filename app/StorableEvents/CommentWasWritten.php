<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class CommentWasWritten implements ShouldBeStored
{
    public array $attributes;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }
}
