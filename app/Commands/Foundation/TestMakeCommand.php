<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\TestMakeCommand as TestMake;
use Illuminate\Support\Str;
use App\Commands\Helpers\PackageDetail;

class TestMakeCommand extends TestMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new test for your package';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('unit')) {
            return __DIR__ . '/stubs/unit-test.stub';
        }

        return __DIR__ . '/stubs/test.stub';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->namespaceFromComposer() . 'Tests';
    }

    public function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $dev_path = (app()->environment() == 'development') ? '/package/' . $this->getPackageName() : '';
        $path = getcwd() . $dev_path . '/tests/';
        return $path . str_replace('\\', '/', $name) . '.php';
    }
}
