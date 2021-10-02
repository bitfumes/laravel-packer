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
         * Execute the console command.
         *
         * @return mixed
         */
    public function handle()
    {
        $this->makeFile();
        $this->info('A Json file to define model structure is created. CRUD it fast.');
    }

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
        $name  = $this->argument('model_name');
        $name  = explode('.', $name)[0];
        return ucfirst($name) . '.json';
    }

    public function getPath()
    {
        $path            = getcwd() . $this->devPath();
        return $path . '/crud';
    }
}
