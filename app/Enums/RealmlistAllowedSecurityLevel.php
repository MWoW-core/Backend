<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Player()
 * @method static static Moderator()
 * @method static static GameMaster()
 * @method static static Administrator()
 * @method static static Console()
 */
final class RealmlistAllowedSecurityLevel extends Enum
{
    const Player = 0;
    const Moderator = 1;
    const GameMaster = 2;
    const Administrator = 3;
    const Console = 4;
}
