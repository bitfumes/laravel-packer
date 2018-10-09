<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\RequestMakeCommand as RequestMake;
use App\Commands\Helpers\PackageDetail;

class RequestMakeCommand extends RequestMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Request class in your package';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/request.stub';
    }
}
