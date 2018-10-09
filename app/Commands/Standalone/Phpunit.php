<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class Phpunit extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:phpunit';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create phpunit.xml file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Phpunit.stub';
    }

    public function getFilename()
    {
        return 'phpunit.xml';
    }

    public function getPath()
    {
        return cache()->get('package_path');
    }
}
