<?php

namespace App\Commands\Foundation;

use Illuminate\Support\Str;
use App\Commands\Helpers\PackageDetail;
use Illuminate\Foundation\Console\ModelMakeCommand as ModelMake;

class ModelMakeCommand extends ModelMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class in your package';

    public function getPath($name)
    {
        $content = $this->getComposer();
        $name    = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path    = getcwd() . $this->devPath();
        $path    = $content->type === 'project' ? $path . '/app/Models/' : $path . '/src/Models/';
        return  $path . str_replace('\\', '/', $name) . '.php';
    }

    /**
    * Build the class with the given name.
    *
    * @param  string  $name
    * @return string
    * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
    */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        $stub = $this->replaceModelNamespace($stub);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    public function replaceModelNamespace($stub)
    {
        return str_replace('{{ namespace }}', $this->rootNamespace() . 'Models', $stub);
    }
}
