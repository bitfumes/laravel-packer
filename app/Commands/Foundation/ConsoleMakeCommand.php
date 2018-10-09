<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\ConsoleMakeCommand as ConsoleMake;
use App\Commands\Helpers\PackageDetail;

class ConsoleMakeCommand extends ConsoleMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Artisan command';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/console.stub';
    }
}
