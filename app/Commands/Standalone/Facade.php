<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class Facade extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:facade';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create Facade for package';

    public function getStub()
    {
        return __DIR__ . '/stubs/Facade.stub';
    }

    public function getFilename()
    {
        return studly_case(cache()->get('package_name')) . 'Facade.php';
    }

    public function getPath()
    {
        return cache()->get('package_path') . '/src';
    }
}
