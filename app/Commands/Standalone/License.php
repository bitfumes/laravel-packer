<?php

namespace App\Commands\Standalone;

use App\Commands\Helpers\MakeFile;

class License extends MakeFile
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create:license';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create License file';

    public function getStub()
    {
        return __DIR__ . '/stubs/License.stub';
    }

    public function getFilename()
    {
        return 'LICENSE.md';
    }

    public function getPath()
    {
        return cache()->get('package_path');
    }
}
