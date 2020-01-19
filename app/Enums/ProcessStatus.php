<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * Class ProcessStatus
 * @package App\Enums
 *
 * @method static ProcessStatus PENDING()
 * @method static ProcessStatus RUNNING()
 * @method static ProcessStatus FAILED()
 * @method static ProcessStatus SUCCESS()
 */
final class ProcessStatus extends Enum
{
    const PENDING = 'pending';
    const RUNNING = 'running';
    const FAILED = 'failed';
    const SUCCESS = 'success';
}
