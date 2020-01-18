<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class NewsCreated implements ShouldBeStored
{
    public int $writerId;
    public array $attributes = [];

    /**
     * NewsCreated constructor.
     *
     * @param int $writerId
     * @param array $attributes
     */
    public function __construct(int $writerId, array $attributes)
    {
        $this->writerId = $writerId;
        $this->attributes = $attributes;
    }
}
