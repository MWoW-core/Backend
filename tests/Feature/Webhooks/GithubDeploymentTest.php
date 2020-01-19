<?php

namespace Tests\Feature\Webhooks;

use App\Enums\ProcessStatus;
use App\GithubSignature;
use App\Jobs\RunProcess;
use App\Process;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class GithubDeploymentTest extends TestCase
{
    use RefreshDatabase;

    public function testRequestFailsIfTheSignatureHeaderIsInvalid()
    {
        $this
            ->postJson('/webhooks/github/deploy', [], ['HTTP_X_HUB_SIGNATURE' => 'INVALID'])
            ->assertUnauthorized()
            ->assertSee('Invalid GitHub signature.');
    }

    public function testItStartsAProcess()
    {
        Bus::fake(RunProcess::class);

        config(['services.github.deployment_secret' => 'testing']);

        $this
            ->postJson('/webhooks/github/deploy', [], ['HTTP_X_HUB_SIGNATURE' => GithubSignature::make('[]')])
            ->assertSuccessful();

        $process = Process::query()
            ->where('status', ProcessStatus::PENDING)
            ->where('script', 'scripts.github.deploy')
            ->firstOrFail();

        Bus::assertDispatched(RunProcess::class, fn (RunProcess $job) => $job->process->is($process));
    }
}
