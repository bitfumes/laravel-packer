<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class Contributing extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:contributing';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create Contributing file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Contributing.stub';
    }

    public function getFilename()
    {
        return 'CONTRIBUTING.md';
    }

    public function getPath()
    {
        return cache()->get('package_path');
    }
}
