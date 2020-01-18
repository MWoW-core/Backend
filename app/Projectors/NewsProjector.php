<?php

namespace App\Projectors;

use App\News;
use App\StorableEvents\NewsCreated;
use App\StorableEvents\NewsDeleted;
use App\StorableEvents\NewsUpdated;
use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;

final class NewsProjector implements Projector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        NewsCreated::class,
        NewsUpdated::class,
        NewsDeleted::class
    ];

    public function onNewsCreated(NewsCreated $event)
    {
        News::query()->create($event->attributes + ['writer_id' => $event->writerId]);
    }

    public function onNewsUpdated(NewsUpdated $event)
    {
        News::query()->whereKey($event->newsId)->update($event->attributes);
    }

    public function onNewsDeleted(NewsDeleted $event)
    {
        News::query()->whereKey($event->newsId)->delete();
    }
}
