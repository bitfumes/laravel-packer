<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class StyleCI extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:styleci';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create StyleCI file';

    public function getStub()
    {
        return __DIR__ . '/stubs/StyleCI.stub';
    }

    public function getFilename()
    {
        return '.styleci.yml';
    }

    public function getPath()
    {
        return cache()->get('package_path');
    }
}
