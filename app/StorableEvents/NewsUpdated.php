<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class NewsUpdated implements ShouldBeStored
{
    public int $newsId;
    public array $attributes = [];

    /**
     * NewsUpdated constructor.
     *
     * @param int $newsId
     * @param array $attributes
     */
    public function __construct(int $newsId, array $attributes)
    {
        $this->newsId = $newsId;
        $this->attributes = $attributes;
    }
}
