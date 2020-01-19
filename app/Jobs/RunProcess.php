<?php

namespace App\Jobs;

use App\Process;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RunProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Process $process;

    /**
     * RunProcess constructor.
     *
     * @param Process $process
     */
    public function __construct(Process $process)
    {
        $this->process = $process;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->process->run();
    }
}
