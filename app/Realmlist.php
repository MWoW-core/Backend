<?php

namespace App;

use App\Enums\RealmlistAllowedSecurityLevel;
use App\Enums\RealmlistFlag;
use App\Enums\RealmlistGamebuild;
use App\Enums\RealmlistIcon;
use App\Enums\RealmlistTimezone;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Realmlist
 */
class Realmlist extends Model
{
    use CastsEnums;

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
        'timezone',
        'allowedSecurityLevel',
        'population',
        'gamebuild'
    ];

    protected $casts = [
        'icon' => 'integer',
        'flag' => 'integer',
        'timezone' => 'integer',
        'allowedSecurityLevel' => 'integer',
        'gamebuild' => 'integer'
    ];

    protected $enumCasts = [
        'icon' => RealmlistIcon::class,
        'flag' => RealmlistFlag::class,
        'timezone' => RealmlistTimezone::class,
        'allowedSecurityLevel' => RealmlistAllowedSecurityLevel::class,
        'gamebuild' => RealmlistGamebuild::class
    ];

    public function realmCharacters()
    {
        return $this->hasMany(Realmcharacter::class, 'realmid');
    }

    public function accounts()
    {
        return $this->hasManyThrough(Account::class, Realmcharacter::class, 'acctid', 'id');
    }
}
