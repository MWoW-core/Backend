<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class AccountBan extends Model
{
    protected $connection = 'auth';

    protected $table = 'account_banned';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'bandate',
        'unbandate',
        'bannedby',
        'banreason',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function getBandateAttribute($value)
    {
        if ($value) {
            return Date::createFromTimestamp($value);
        }

        return null;
    }

    public function setBandateAttribute($value)
    {
        if ($value) {
            $this->attributes['bandate'] = Date::parse($value)->unix();
        }
    }

    public function getUnbandateAttribute($value)
    {
        if ($value) {
            return Date::createFromTimestamp($value);
        }

        return null;
    }

    public function setUnbandateAttribute($value)
    {
        if ($value) {
            $this->attributes['unbandate'] = Date::parse($value)->unix();
        }
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'id', 'id');
    }
}
