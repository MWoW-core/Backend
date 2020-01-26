<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static Normal()
 * @method static static PvP()
 * @method static static RP()
 * @method static static RPPvP()
 */
final class RealmlistIcon extends Enum implements LocalizedEnum
{
    const Normal = 0;
    const PvP = 1;
    // const Normal = 4;
    const RP = 6;
    const RPPvP = 8;
}
