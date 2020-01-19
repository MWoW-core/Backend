<?php

namespace App;

use App\Enums\ProcessStatus;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use Symfony\Component\Process\Process as SymfonyProcess;

/**
 * Class Process
 * @package App
 * @mixin Builder
 * @property ProcessStatus $status
 * @property string $script
 * @property array $script_parameters
 * @property string $script_output
 * @property Carbon|null $executed_at
 */
class Process extends Model
{
    use CastsEnums;

    protected $fillable = [
        'status',
        'script',
        'script_parameters',
        'script_output',
        'executed_at'
    ];

    protected $casts = [
        'script_parameters' => 'array',
        'executed_at' => 'datetime'
    ];

    public $enumCasts = [
        'status' => ProcessStatus::class
    ];

    public function updateStatus(ProcessStatus $status)
    {
        $this->update([
            'status' => (string)$status
        ]);

        return $this;
    }

    public function run(): void
    {
        $this->updateStatus(ProcessStatus::RUNNING());

        $process = SymfonyProcess::fromShellCommandline(
            $this->renderScript()
        );

        $process->run(fn ($type, $stdout) => $this->script_output .= $stdout);

        $this->status = $process->isSuccessful() ? ProcessStatus::SUCCESS : ProcessStatus::FAILED;
        $this->executed_at = $this->freshTimestampString();
        $this->saveOrFail();
    }

    public function renderScript(): string
    {
        $view = View::make($this->script);

        foreach ($this->script_parameters as $key => $value) {
            $view->with($key, $value);
        }
        return $view->render();
    }
}

