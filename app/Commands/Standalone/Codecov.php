<?php

namespace App\Commands\Standalone;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;

class Codecov extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:codecov';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create codecov file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Codecov.stub';
    }

    public function getFilename()
    {
        return '.codecov.yml';
    }

    public function getPath()
    {
        return cache()->get('package_path');
    }
}
