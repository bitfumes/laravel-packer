<?php

namespace App\Commands\Crud;

use Illuminate\Support\Str;
use App\Commands\Helpers\PackageDetail;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class for CRUD generator';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return false;
        }

        if ($this->option('all')) {
            $this->input->setOption('factory', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
            $this->input->setOption('resource', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('controller') || $this->option('resource')) {
            $this->createController();
        }
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

        $stub = $this->addMoreTo($stub);

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->argument('name')));

        $this->call('crud:factory', [
            'name'    => "{$factory}Factory",
            '--model' => $this->qualifyClass($this->getNameInput()),
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('crud:migration', [
            'name'     => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass($this->getNameInput());

        $this->call('crud:controller', [
            'name'    => "{$controller}Controller",
            '--model' => $this->option('resource') ? $modelName : null,
            '--api'   => cache()->get('structure')->type == 'api',
        ]);
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
            return __DIR__ . '/stubs/pivot.model.stub';
        }

        return __DIR__ . '/stubs/model.stub';
    }

    protected function addMoreTo($stub)
    {
        $attr      = '';
        $structure = cache()->get('structure');
        foreach ($structure->fields as $field) {
            $attr .= "'$field->name', ";
        }
        $fillable = 'protected $fillable = ' . "[$attr];";

        if (isset($structure->relationships)) {
            $fillable = $this->addRelationship($fillable, $structure->relationships);
            $this->callSilent('crud:test', [
                'name'     => $this->getNameInput() . 'Test',
                '--model'  => $this->getNameInput(),
                '--unit'   => true,
            ]);
        }
        return  str_replace('//', $fillable, $stub);
    }

    protected function addRelationship($fillable, $relationships)
    {
        $rel = '';
        foreach ($relationships as $relationship) {
            $foreign = isset($relationship->foreign_key) ? ",'{$relationship->foreign_key}'" : '';
            $local   = isset($relationship->local) ? ",'{$relationship->local}'" : '';
            $rel .= '
    public function ' . $relationship->name . '()
    {
        return $this->' . "{$relationship->type}({$relationship->model}::class{$foreign}{$local});" . '
    }
        ';
        }
        return "{$fillable} 
        {$rel}";
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, factory, and resource controller for the model'],

            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model'],

            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the model'],

            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists'],

            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model'],

            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model'],

            ['resource', 'r', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],
        ];
    }

    public function getPath($name)
    {
        $content = $this->getComposer();
        $name    = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path    = getcwd() . $this->devPath();
        $path    = $content->type === 'project' ? $path . '/app/' : $path . '/src/';
        return  $path . str_replace('\\', '/', $name) . '.php';
    }
}
