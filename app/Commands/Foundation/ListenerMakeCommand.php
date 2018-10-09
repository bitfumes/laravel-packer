<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\ListenerMakeCommand as ListenerMake;
use App\Commands\Helpers\PackageDetail;

class ListenerMakeCommand extends ListenerMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new event listener class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('queued')) {
            return $this->option('event')
                ? __DIR__ . '/stubs/listener-queued.stub'
                : __DIR__ . '/stubs/listener-queued-duck.stub';
        }

        return $this->option('event')
            ? __DIR__ . '/stubs/listener.stub'
            : __DIR__ . '/stubs/listener-duck.stub';
    }
}
