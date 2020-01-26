<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static None()
 * @method static static Invalid()
 * @method static static Offline()
 * @method static static SpecifyBuild()
 * @method static static Medium()
 * @method static static NewPlayers()
 * @method static static Recommended()
 */
final class RealmlistFlag extends Enum
{
    const None = 0;
    const Invalid = 1;
    const Offline = 2;
    const SpecifyBuild = 4;
    const Medium = 8;
    // const Medium = 16;
    const NewPlayers = 32;
    const Recommended = 64;
    const Full = 128;
}
