<?php

namespace App\Projectors;

use App\Enums\ProcessStatus;
use App\Jobs\RunProcess;
use App\Process;
use App\StorableEvents\ProcessWasStarted;
use Spatie\EventSourcing\Projectors\Projector;
use Spatie\EventSourcing\Projectors\ProjectsEvents;

final class ProcessProjector implements Projector
{
    use ProjectsEvents;

    protected $handlesEvents = [
        ProcessWasStarted::class
    ];

    public function onProcessWasStarted(ProcessWasStarted $event)
    {
        dispatch(
            new RunProcess(
                Process::create([
                    'status' => ProcessStatus::PENDING,
                    'script' => $event->script,
                    'script_parameters' => $event->parameters
                ])
            )
        );
    }
}
