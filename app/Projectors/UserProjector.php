<?php

namespace App\Projectors;

use App\StorableEvents\UserPasswordChanged;
use App\User;
use Illuminate\Support\Facades\Hash;
use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;

final class UserProjector implements Projector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        UserPasswordChanged::class
    ];

    public function onUserPasswordChanged(UserPasswordChanged $event)
    {
        User::query()->whereKey($event->userId)->update([
            'password' => Hash::make($event->decryptPassword())
        ]);
    }
}
