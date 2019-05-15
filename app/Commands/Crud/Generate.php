<?php

namespace App\Commands\Crud;

use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class Generate extends Command
{

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'generate:crud {model} {file}';

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
        $model = $this->argument('model');
        $structure = json_decode(file_get_contents($this->argument('file')));

        Cache::forever('structure', $structure);
        $this->callSilent("crud:model", [
            'name' => $model,
            '-r' => true,
            '-m' => true,
            '-f'  => true
        ]);

        $this->callSilent("crud:test", [
            'name' => "{$model}Test",
            "--model" => $model
        ]);

        if ($structure->type == 'web') {
            $this->callSilent("crud:views", [
                'name' => $model
            ]);
        }
    }
}
