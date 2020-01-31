<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class CommentWasDeleted implements ShouldBeStored
{
    public int $commentId;

    /**
     * CommentWasDeleted constructor.
     * @param int $commentId
     */
    public function __construct(int $commentId)
    {
        $this->commentId = $commentId;
    }
}
