<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class CommentWasUpdated implements ShouldBeStored
{
    public int $commentId;
    public array $attributes;

    /**
     * CommentWasUpdated constructor.
     * @param int $commentId
     * @param array $attributes
     */
    public function __construct(int $commentId, array $attributes)
    {
        $this->commentId = $commentId;
        $this->attributes = $attributes;
    }
}
