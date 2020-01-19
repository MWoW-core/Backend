<?php

namespace App\Http\Controllers\Webhooks\Github;

use App\Http\Controllers\Controller;
use App\StorableEvents\ProcessWasStarted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class HandleGithubDeployment extends Controller
{
    public function __invoke()
    {
        Event::dispatch(
            new ProcessWasStarted(
                'scripts.github.deploy'
            )
        );
    }
}
