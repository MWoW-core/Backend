<?php

namespace App\StorableEvents;

use Spatie\EventSourcing\ShouldBeStored;

final class ProcessWasStarted implements ShouldBeStored
{
    public string $script;
    public array $parameters = [];

    /**
     * ProcessWasStarted constructor.
     * @param string $script
     * @param array $parameters
     */
    public function __construct(string $script, array $parameters = [])
    {
        $this->script = $script;
        $this->parameters = $parameters;
    }
}
