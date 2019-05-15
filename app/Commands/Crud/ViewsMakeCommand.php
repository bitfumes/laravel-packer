<?php

namespace App\Commands\Crud;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use App\Commands\Helpers\PackageDetail;

class ViewsMakeCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:views';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a view files for CRUD generator';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'view';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->addRouteLine();

        $this->callSilent('crud:layout.app', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:layout.flash', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:view.index', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:view.create', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:view.edit', [
            'name' => $this->argument('name')
        ]);
    }

    protected function getStub()
    {
        return '/../stubs/views/index.stub';
    }

    public function addRouteLine()
    {
        $path = getcwd() . $this->devPath();
        $path = $this->getRouteFilePath($path);
        if ($path) {
            $this->addLine($path);
        }
    }

    public function addLine($path)
    {
        $model = $this->argument('name');
        $routes = "\nRoute::resource('" . strToLower($model) . "','" . $model . "Controller');";
        file_put_contents($path, $routes, FILE_APPEND);
    }

    public function getRouteFilePath($path)
    {
        $content = $this->getComposer();
        if ($content->type == 'project') {
            $path = $path . '/routes/web.php';
        } elseif ($content->type == 'library' || $content->type == 'package') {
            $path = $this->packageRoutePath($path);
        }
        return $path;
    }

    public function packageRoutePath($path)
    {
        $provider = file($path . '/src/' . $this->getPackageName() . 'ServiceProvider.php');
        $routeLine = $this->readServiceProvider($provider);
        if ($routeLine == '') {
            return false;
        }
        return $this->extractFileNameAndPath($routeLine, $path);
    }

    public function readServiceProvider($provider)
    {
        $routeLine = '';
        foreach ($provider as $line) {
            if (str_contains($line, '$this->loadRoutesFrom')) {
                $routeLine = $line;
            }
        }
        return $routeLine;
    }

    public function extractFileNameAndPath($routeLine, $path)
    {
        preg_match('/__DIR__\s?.\s?(\'|")(\/\w+)+\/(\w+.php)(?=(\'|")\);)/', $routeLine, $matches);
        $path =  "{$path}/src{$matches[2]}";
        $routePathWithFileName =  "$path/$matches[3]";
        if (!file_exists("$path/$matches[3]")) {
            $this->callSilent('make:routefile', [
                'name' => $matches[3],
                'path' => $path
            ]);
        }
        return $routePathWithFileName;
    }
}
