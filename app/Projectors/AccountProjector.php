<?php

namespace App\Projectors;

use App\Account;
use App\StorableEvents\AccountRegistered;
use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;

final class AccountProjector implements Projector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        AccountRegistered::class
    ];

    public function onAccountRegistered(AccountRegistered $event)
    {
        Account::query()->create($event->attributes);
    }
}
