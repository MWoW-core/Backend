<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Development()
 * @method static static UnitedStates()
 * @method static static Oceanic()
 * @method static static LatinAmerica()
 * @method static static Tournament()
 * @method static static Korea()
 * @method static static English()
 * @method static static German()
 * @method static static French()
 * @method static static Spanish()
 * @method static static Russian()
 * @method static static Taiwan()
 * @method static static China()
 */
final class RealmlistTimezone extends Enum
{
    const Unknown = 0;
    const Development = 1;
    const UnitedStates = 2;
    const Oceanic = 3;
    const LatinAmerica = 4;
    const Tournament = 5;
    const Korea = 6;
    // const Tournament = 7;
    const English = 8;
    const German = 9;
    const French = 10;
    const Spanish = 11;
    const Russian = 12;
    // const Tournament = 13;
    const Taiwan = 14;
    // const Tournament = 15;
    const China = 16;
}
