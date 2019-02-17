<?php

namespace App\Commands\Foundation;

use Illuminate\Console\GeneratorCommand;
use App\Commands\Helpers\PackageDetail;

class PhpClassMakeCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:phpclass {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create a php class file for your package';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/phpclass.stub';
    }
}
