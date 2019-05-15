<?php

namespace App\Commands\Crud;

use Illuminate\Console\GeneratorCommand;
use App\Commands\Helpers\PackageDetail;

class RouteMakeCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:routefile';
    protected $signature = 'make:routefile {path} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a route files for package';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'class';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->createRouteFile();
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/routes.stub';
    }

    public function createRouteFile()
    {
        $path = $this->argument('path');
        $name = $this->argument('name');

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $stub = file_get_contents($this->getStub());
        file_put_contents("$path/$name", $stub);
    }
}
