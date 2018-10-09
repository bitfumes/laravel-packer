<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\EventMakeCommand as EventMake;
use App\Commands\Helpers\PackageDetail;

class EventMakeCommand extends EventMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new event class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/event.stub';
    }
}
