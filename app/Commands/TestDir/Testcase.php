<?php

namespace App\Commands\TestDir;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;

class Testcase extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:testcase';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create testcase file inside tests directory';

    public function getStub()
    {
        return __DIR__ . '/stubs/TestCase.stub';
    }

    public function getFilename()
    {
        return 'TestCase.php';
    }

    public function getPath()
    {
        return cache()->get('package_path') . '/tests';
    }
}
