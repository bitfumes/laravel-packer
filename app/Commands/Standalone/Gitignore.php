<?php

namespace App\Commands\Standalone;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;

class Gitignore extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:gitignore';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create Git Ignore file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Gitignore.stub';
    }

    public function getFilename()
    {
        return '.gitignore';
    }

    public function getPath()
    {
        return cache()->get('package_path');
    }
}
