<?php

namespace App\Commands\Standalone;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;

class Travis extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:travis';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create travis file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Travis.stub';
    }

    public function getFilename()
    {
        return '.travis.yml';
    }

    public function getPath()
    {
        return cache()->get('package_path');
    }
}
