<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class Account
 */
class Account extends Model
{
    protected $connection = 'auth';

    protected $table = 'account';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'sha_pass_hash',
        'sessionkey',
        'v',
        's',
        'token_key',
        'email',
        'reg_mail',
        'joindate',
        'last_ip',
        'last_attempt_ip',
        'failed_logins',
        'locked',
        'lock_country',
        'last_login',
        'online',
        'expansion',
        'mutetime',
        'mutereason',
        'muteby',
        'locale',
        'os',
        'recruiter'
    ];

    public function realmCharacters()
    {
        return $this->hasMany(Realmcharacter::class, 'acctid');
    }

    public function realms()
    {
        return $this->hasManyThrough(Realmlist::class, Realmcharacter::class, 'acctid', 'id', 'id')->withoutGlobalScopes(['withAccountsCount']);
    }
}