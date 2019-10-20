<?php

namespace App\Commands\Crud;

use App\Commands\Helpers\PackageDetail;
use Illuminate\Console\GeneratorCommand;

class AddRouteCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name      = 'crud:addRoute';
    protected $signature = 'crud:addRoute {name} {--api : Create apiResource route}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Append route for new crud';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->addRouteLine();
    }

    public function getStub()
    {
        //
    }

    public function addRouteLine()
    {
        $path = getcwd() . $this->devPath();
        $path = $this->getComposer()->type === 'library' ? $path . 'src/' : $path;
        $path = $this->getRouteFilePath($path);
        if ($path) {
            $this->addLine($path);
        }
    }

    public function addLine($path)
    {
        $model        = $this->argument('name');
        $resourceType = $this->option('api') == 'api' ? 'apiResource' : 'resource';
        $routes       = "\nRoute::{$resourceType}('" . strToLower($model) . "','" . studly_case($model) . "Controller');";
        file_put_contents($path, $routes, FILE_APPEND);
    }

    public function getRouteFilePath($path)
    {
        $content = $this->getComposer();
        if ($content->type == 'project') {
            $path = $this->option('api') == 'api' ? $path . 'routes/api.php' : $path . 'routes/web.php';
        } elseif ($content->type == 'library' || $content->type == 'package') {
            $path = $this->packageRoutePath($path);
        }
        return $path;
    }

    public function packageRoutePath($path)
    {
        $provider  = file($path . $this->getPackageName() . 'ServiceProvider.php');
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
        $path                  =  "{$path}{$matches[2]}";
        $routePathWithFileName =  "$path/$matches[3]";
        if (!file_exists("$path/$matches[3]")) {
            $this->callSilent('make:routefile', [
                'name' => $matches[3],
                'path' => $path,
            ]);
        }
        return $routePathWithFileName;
    }
}
