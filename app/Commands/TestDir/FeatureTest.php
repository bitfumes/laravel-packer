<?php

namespace App\Commands\TestDir;

use LaravelZero\Framework\Commands\Command;
use App\Commands\Helpers\MakeFile;

class FeatureTest extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:featuretest';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create example feature test file inside tests/feature directory';

    public function getStub()
    {
        return __DIR__ . '/stubs/FeatureTest.stub';
    }

    public function getFilename()
    {
        return 'ExampleTest.php';
    }

    public function getPath()
    {
        return cache()->get('package_path') . '/tests/Feature';
    }
}
