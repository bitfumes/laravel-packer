<?php

namespace App\Commands\Crud;

use App\Commands\Helpers\MakeFile;
use App\Commands\Helpers\PackageDetail;

class JsonMakeCommand extends MakeFile
{
    use PackageDetail;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'crud:json {model_name : Name of the json file you want to give.}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create Json file to define structure of model';

    public function getStub()
    {
        return __DIR__ . '/stubs/json.stub';
    }

    public function getFilename()
    {
        return ucfirst($this->argument('model_name')) . '.json';
    }

    public function getPath()
    {
        $name = $this->rootNamespace();
        return getcwd() . $this->devPath() . '/crud';
    }
}
