<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class UserRole
 * @package App\Enums
 *
 * @method static UserRole Player()
 * @method static UserRole Admin()
 */
final class UserRole extends Enum
{
    const Player = 'Player';
    const Admin = 'Administrator';
}
