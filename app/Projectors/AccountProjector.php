<?php

namespace App\Projectors;

use App\Account;
use App\AccountPassword;
use App\StorableEvents\AccountPasswordChanged;
use App\StorableEvents\AccountRegistered;
use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;

final class AccountProjector implements Projector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        AccountRegistered::class,
        AccountPasswordChanged::class
    ];

    public function onAccountRegistered(AccountRegistered $event)
    {
        Account::query()->create($event->attributes);
    }

    public static function onAccountPasswordChanged(AccountPasswordChanged $event)
    {
        $account = Account::query()->findOrFail($event->accountId);

        $account->update(['sha_pass_hash' => AccountPassword::make($event->decryptPassword(), $account->username)]);
    }
}
