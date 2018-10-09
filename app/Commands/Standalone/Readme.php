<?php

namespace App\Commands\Standalone;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;
use Illuminate\Support\Facades\Cache;

class Readme extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:readme';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create readme file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Readme.stub';
    }

    public function getFilename()
    {
        return 'README.md';
    }

    public function getPath()
    {
        return Cache::get('package_path');
    }
}
