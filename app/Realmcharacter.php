<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Realmcharacter
 */
class Realmcharacter extends Model
{
    protected $connection = 'auth';

    protected $primaryKey = 'realmid';

    protected $table = 'realmcharacters';

    public $timestamps = false;

    protected $fillable = [
        'realmid',
        'acctid',
        'numchars'
    ];

    protected $casts = ['numchars' => 'integer'];

    public function realm()
    {
        return $this->belongsTo(Realmlist::class, 'realmid');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'acctid');
    }
}