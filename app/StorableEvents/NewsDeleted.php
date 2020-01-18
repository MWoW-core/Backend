<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class NewsDeleted implements ShouldBeStored
{
    public int $newsId;

    /**
     * NewsDeleted constructor.
     * @param int $newsId
     */
    public function __construct(int $newsId)
    {
        $this->newsId = $newsId;
    }
}
