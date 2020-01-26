<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RealmlistGamebuild extends Enum implements LocalizedEnum
{
    const Classic = self::Classic_OneTwelveTwo;
    const TBC = 8606;
    const WoTLK = self::WoTLK_ThreeThreeFiveA;

    const Classic_OneTwelveOne = 5875;
    const Classic_OneTwelveTwo = 6005;
    const WoTLK_ThreeOneThree = 9947;
    const WoTLK_ThreeTwoZero = 10146;
    const WoTLK_ThreeTwoTwoA = 10505;
    const WoTLK_ThreeThreeZero = 10571;
    const WoTLK_ThreeThreeZeroA = 11159;
    const WoTLK_ThreeThreeTwo = 11403;
    const WoTLK_ThreeThreeThree = 11623;
    const WoTLK_ThreeThreeThreeA = 11723;
    const WoTLK_ThreeThreeFiveA = 12340;
}
