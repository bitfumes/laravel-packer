<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\JobMakeCommand as JobMake;
use App\Commands\Helpers\PackageDetail;

class JobMakeCommand extends JobMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new job class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('sync')
            ? __DIR__ . '/stubs/job.stub'
            : __DIR__ . '/stubs/job-queued.stub';
    }
}
