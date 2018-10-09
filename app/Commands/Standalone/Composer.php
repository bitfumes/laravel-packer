<?php

namespace App\Commands\Standalone;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;
use Illuminate\Support\Facades\Cache;

class Composer extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:composer';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create composer.json file';

    public function getStub()
    {
        return __DIR__ . '/stubs/Composer.stub';
    }

    public function getFilename()
    {
        return 'composer.json';
    }

    public function getPath()
    {
        return Cache::get('package_path');
    }
}
