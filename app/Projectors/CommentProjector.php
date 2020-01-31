<?php

namespace App\Projectors;

use App\Comment;
use App\StorableEvents\CommentWasDeleted;
use App\StorableEvents\CommentWasUpdated;
use App\StorableEvents\CommentWasWritten;
use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;

final class CommentProjector implements Projector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        CommentWasWritten::class,
        CommentWasUpdated::class,
        CommentWasDeleted::class
    ];

    public function onCommentWasWritten(CommentWasWritten $event)
    {
        Comment::query()->create($event->attributes);
    }

    public function onCommentWasUpdated(CommentWasUpdated $event)
    {
        Comment::query()->whereKey($event->commentId)->update($event->attributes);
    }

    public function onCommentWasDeleted(CommentWasDeleted $event)
    {
        Comment::query()->whereKey($event->commentId)->delete();
    }
}
