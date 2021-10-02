<?php

namespace App\Commands\Crud;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Commands\Helpers\PackageDetail;
use LaravelZero\Framework\Commands\Command;

class CrudMakeCommand extends Command
{
    use PackageDetail;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'crud:make
    {file : Get structure of Model and model name as file name}
    {--model : Model name if you want to override json file name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Generate CRUD for any model, along with Model, Migration, Factory and Tests';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $structure = $this->getStructureFromFile();
        $model     = $this->modelName();

        Cache::forever('structure', $structure);
        $this->call('crud:model', [
            'name' => $model,
            '-r'   => true,
            '-m'   => true,
            '-f'   => true,
        ]);

        $this->call('crud:test', [
            'name'    => "{$model}Test",
            '--model' => $model,
        ]);

        if ($structure->type == 'web') {
            $this->call('crud:views', [
                'name' => $model,
            ]);
        } else {
            $this->call('crud:addRoute', [
                'name'  => $model,
                '--api' => $structure->type == 'api',
            ]);
        }
    }

    public function getStructureFromFile()
    {
        return json_decode(file_get_contents($this->filePath()));
    }

    public function modelName()
    {
        if ($this->option('model')) {
            return $this->option('model');
        }
        $exploded = explode('/', $this->argument('file'));
        return ucfirst(str_replace('.json', '', end($exploded)));
    }

    public function filePath()
    {
        $file      = $this->argument('file');
        $file_path = $this->getPath("crud/$file") . '.json';
        if (!file_exists($file_path)) {
            $this->error('File not found, please give relative path.');
            die();
        }
        return $file_path;
    }

    public function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path = getcwd() . $this->devPath();
        return $path . str_replace('\\', '/', $name);
    }
}
