<?php

namespace App;

use App\Enums\AccountExpansion;
use App\User;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use function optional;

/**
 * Class Account
 * @package App
 * @mixin Builder
 *
 * @property integer $id
 * @property string $username [Ref: users.account_name]
 * @property string $sha_pass_hash
 * @property string $sessionkey
 * @property string $v
 * @property string $s
 * @property string $token_key
 * @property string $email
 * @property string $reg_mail
 * @property Carbon $joindate
 * @property string $last_ip
 * @property string $last_attempt_ip
 * @property integer $failed_logins
 * @property boolean $locked
 * @property string $lock_country
 * @property Carbon $last_login
 * @property boolean $online
 * @property AccountExpansion $expansion
 * @property Carbon $mutetime
 * @property string $mutereason
 * @property string $muteby
 * @property integer $locale
 * @property string $os
 * @property integer $recruiter
 * @property integer $vp
 * @property integer $dp
 * @property-read string $status
 *
 * @property-read Account|null $recruiterAccount
 * @property-read Collection $bans
 * @property-read Collection $realmCharacters
 * @property-read Collection $realms
 */
class Account extends Model
{
    use CastsEnums;

    protected $connection = 'auth';

    protected $table = 'account';

    public $timestamps = false;

    protected $fillable = [
        'id',
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
        'recruiter',
        'vp',
        'dp'
    ];

    protected $casts = [
        'joindate' => 'datetime',
        'last_login' => 'datetime',
        'mutetime' => 'datetime',
        'locked' => 'boolean',
        'online' => 'boolean',
        'vp' => 'integer',
        'dp' => 'integer'
    ];

    protected $enumCasts = [
        'expansion' => AccountExpansion::class
    ];

    public function ban(string $reason, $date = null, ?string $bannedby = null): AccountBan
    {
        $ban = new AccountBan([
            'id' => $this->id,
            'bannedby' => (string)($bannedby ?? optional(Auth::user())->account_name),
            'banreason' => $reason,
            'bandate' => Date::parse($date)->unix(),
            'active' => true
        ]);

        $this->bans()->save($ban);

        return $ban;
    }

    public function unban(): Account
    {
        $this->bans->each->update(['active' => false]);

        return $this;
    }

    public function getStatusAttribute(): string
    {
        if ($this->bans->isNotEmpty()) {
            return $this->bans->some->active
                ? 'Banned'
                : 'Unbanned';
        }

        if ($this->online) {
            return 'Online';
        }

        return 'Offline';
    }

    public function recruiterAccount()
    {
        return $this->belongsTo(Account::class, 'recruiter', 'id');
    }

    public function bans()
    {
        return $this->hasMany(AccountBan::class, 'id', 'id');
    }

    public function realmCharacters()
    {
        return $this->hasMany(Realmcharacter::class, 'acctid');
    }

    public function realms()
    {
        return $this->hasManyThrough(Realmlist::class, Realmcharacter::class, 'acctid', 'id', 'id')->withoutGlobalScopes(['withAccountsCount']);
    }
}
