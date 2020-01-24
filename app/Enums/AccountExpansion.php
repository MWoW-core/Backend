<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @ref https://trinitycore.atlassian.net/wiki/spaces/tc/pages/2130004/account#account-expansion
 *
 * @method static static Classic()
 * @method static static TBC()
 * @method static static WoTLK()
 * @method static static Cataclysm()
 * @method static static MOP()
 * @method static static WOD()
 * @method static static Legion()
 * @method static static BFA()
 * @method static static SL()
 */
final class AccountExpansion extends Enum implements LocalizedEnum
{
    const Classic = 0;
    const TBC = 1;
    const WoTLK = 2;
    const Cataclysm = 3;
    const MOP = 4;
    const WOD = 5;
    const Legion = 6;
    const BFA = 7;
    const SL = 8;
}
