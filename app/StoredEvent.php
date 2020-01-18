<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Spatie\EventSourcing\Models\EloquentStoredEvent;

class StoredEvent extends EloquentStoredEvent
{
    public static function boot()
    {
        parent::boot();

        static::creating(function($storedEvent) {
            $storedEvent->meta_data['user_id'] = Auth::id();
        });
    }
}
