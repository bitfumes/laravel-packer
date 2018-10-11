<?php

namespace App\Commands\Standalone;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;

class Config extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:config';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create Config file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Config.stub';
    }

    public function getFilename()
    {
        return studly_case(cache()->get('package_name')) . '.php';
    }

    public function getPath()
    {
        return cache()->get('package_path') . '/config';
    }
}
