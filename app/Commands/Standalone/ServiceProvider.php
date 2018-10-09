<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class ServiceProvider extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:provider';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create service provider file at src directory';

    public function getStub()
    {
        return __DIR__ . '/stubs/ServiceProvider.stub';
    }

    public function getFilename()
    {
        return ucfirst(cache()->get('package_name')) . 'ServiceProvider.php';
    }

    public function getPath()
    {
        return cache()->get('package_path') . '/src';
    }
}
