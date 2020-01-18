<?php

namespace App;

use App\Enums\UserRole;
use BenSampo\Enum\Traits\CastsEnums;
use BeyondCode\Comments\Traits\HasComments;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use BeyondCode\Comments\Traits\CanComment;
use BeyondCode\Comments\Contracts\Commentator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Airlock\HasApiTokens;

/**
 * Class User
 * @package App
 * @mixin Builder
 * @property int $id
 * @property string|UserRole $role
 * @property string $account_name
 * @property string $email
 * @property string $password
 * @property-read Collection $notifications
 * @property-read Collection $readNotifications
 * @property-read Collection $unreadNotifications
 * @property-read Collection $comments
 */
class User extends Authenticatable implements Commentator
{
    use CastsEnums, CanComment, HasApiTokens, HasComments, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role', 'name', 'account_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $enumCasts = [
        'role' => UserRole::class
    ];

    public static function findByAccountName(string $accountName): ?User
    {
        return User::where('account_name', $accountName)->first();
    }

    /**
     * Check if a comment for a specific model needs to be approved.
     * @param mixed $model
     * @return bool
     */
    public function needsCommentApproval($model): bool
    {
        return false;
    }
}
