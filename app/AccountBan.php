<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function account()
    {
        return $this->belongsTo(Account::class, 'id', 'id');
    }
}
