<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\ResourceMakeCommand as ResourceMake;
use App\Commands\Helpers\PackageDetail;

class ResourceMakeCommand extends ResourceMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:resource';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Resource class in your package';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->collection()
            ? __DIR__ . '/stubs/resource-collection.stub'
            : __DIR__ . '/stubs/resource.stub';
    }
}
