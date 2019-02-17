<?php

namespace App\Commands\Standalone;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;

class Gitattributes extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:gitattributes';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create Git Attributes file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Gitattributes.stub';
    }

    public function getFilename()
    {
        return '.gitattributes';
    }

    public function getPath()
    {
        return cache()->get('package_path');
    }
}
