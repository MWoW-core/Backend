<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Laravel\Scout\Searchable;

/**
 * Class Realmlist
 */
class Realmlist extends Model
{
    use Searchable;

    protected $connection = 'auth';

    protected $table = 'realmlist';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'address',
        'localAddress',
        'localSubnetMask',
        'port',
        'icon',
        'flag',
        'type',
        'version',
        'status',
        'timezone',
        'allowedSecurityLevel',
        'population',
        'gamebuild'
    ];

    public static $icons = [
        0   =>  'Normal',
        1   =>  'PvP',
        4   =>  'Normal',
        6   =>  'RP',
        8   =>  'RP PvP'
    ];

    public static $flags = [
        0   =>  'None',
        1   =>  'Invalid',
        2   =>  'Offline',
        4   =>  'SpecifyBuild',
        8   =>  'Medium',
        16  =>  'Medium',
        32  =>  'New Players',
        64  =>  'Recommended',
        128 =>  'Full'
    ];

    public static $timezones = [
        1   =>  'Development',
        2   =>  'United States',
        3   =>  'Oceanic',
        4   =>  'Latin America',
        5   =>  'Tournament',
        6   =>  'Korea',
        7   =>  'Tournament',
        8   =>  'English',
        9   =>  'German',
        10  =>  'French',
        11  =>  'Spanish',
        12  =>  'Russian',
        13  =>  'Tournament',
        14  =>  'Taiwan',
        15  =>  'Tournament',
        16  =>  'China'
    ];


    public static function icon(int $id)
    {
        return Arr::get(static::$icons, $id);
    }

    public static function flag(int $id)
    {
        return Arr::get(static::$flags, $id);
    }

    public static function timezone(int $id)
    {
        return Arr::get(static::$timezones, $id);
    }

    public function setTimezoneAttribute($timezone)
    {
        if (is_numeric(($timezone))) {
            return $this->attributes['timezone'] = $timezone;
        }

        return $this->attributes['timezone'] = Arr::get(array_flip(static::$timezones), $timezone, 1);
    }

    public function setTypeAttribute($type)
    {
        if (isset($this->attributes['type'])) {
            unset($this->attributes['type']);
        }

        if (is_numeric($type)) {
            return $this->attributes['icon'] = $type;
        }

        return $this->attributes['icon'] = Arr::get(array_flip(static::$icons), $type, 0);
    }

    public function setStatusAttribute($status)
    {
        if (isset($this->attributes['status'])) {
            unset($this->attributes['status']);
        }

        if (is_numeric($status)) {
            return $this->attributes['flag'] = $status;
        }

        return $this->attributes['flag'] = Arr::get(array_flip(static::$flags), $status, 0);
    }

    public function realmCharacters()
    {
        return $this->hasMany(Realmcharacter::class, 'realmid');
    }

    public function accounts()
    {
        return $this->hasManyThrough(Account::class, Realmcharacter::class, 'acctid', 'id');
    }
}