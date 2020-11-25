<?php

namespace App\Commands\Standalone;

use Illuminate\Support\Str;
use App\Commands\Helpers\MakeFile;
use LaravelZero\Framework\Commands\Command;

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
        return Str::snake(cache()->get('package_name')) . '.php';
    }

    public function getPath()
    {
        return cache()->get('package_path') . '/config';
    }
}
