<?php

namespace App\Commands\Crud;

use Illuminate\Support\Str;
use App\Commands\Helpers\PackageDetail;
use Illuminate\Console\GeneratorCommand;

class TestMakeCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'crud:test {name : The name of the class} {--unit : Create a unit test} {--model : Model to create test for}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new test class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Test';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('unit')) {
            return __DIR__ . '/stubs/tests/unit-test.stub';
        }

        if (cache()->get('structure')->type == 'api') {
            return __DIR__ . '/stubs/tests/test-api.stub';
        } elseif (cache()->get('structure')->type == 'web') {
            return __DIR__ . '/stubs/tests/test-web.stub';
        }
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        $content         = $this->getComposer();
        $loading         = 'autoload-dev';
        $psr             = 'psr-4';
        return key($content->$loading->$psr);
    }

    public function getPath($name)
    {
        $name     = Str::replaceFirst($this->rootNamespace(), '', $name);
        $dev_path = (app()->environment() == 'development') ? '/package/' . $this->getPackageName() : '';
        $path     = getcwd() . $dev_path . '/tests/';
        return $path . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        if ($this->option('unit')) {
            return $rootNamespace . '\Unit';
        } else {
            return $rootNamespace . '\Feature';
        }
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $model = $this->option('model');
        $stub  = str_replace(
            [
                'DummyModelName',
                'DummyModelClass',
                'DummyNamespace',
                'DummyRootNamespace',
                'DummyFullModelClass',
                'DummyModelFieldName',
                'DummyPluralModelName',
                'NamespacedDummyUserModel',
                '//Relationships',
            ],
            [
                strtolower($model),
                ucfirst($model),
                $this->getNamespace($name),
                $this->rootNamespace(),
                $this->namespaceFromComposer() . '' . $model,
                cache()->get('structure')->fields[0]->name,
                Str::plural($model),
                $this->userProviderModel(),
                $this->createRelationships(),
            ],
            $stub
        );

        return $this;
    }

    public function createRelationships()
    {
        $structure = cache()->get('structure');
        $rel       = '';
        if (isset($structure->relationships)) {
            foreach ($structure->relationships as $relationship) {
                if ($relationship->type == 'belongsTo') {
                    $relStub = file_get_contents(__DIR__ . '/stubs/tests/belongsTo.stub');
                }
                $rel .= str_replace(
                    [
                        'DummyModelName',
                        'DummyRelationName',
                        'DummyRootNamespace',
                        'DummyRelationModelName',
                    ],
                    [
                        $this->option('model'),
                        $relationship->name,
                        $this->namespaceFromComposer(),
                        $relationship->model,
                    ],
                    $relStub
                );
            }
        } else {
            return '';
        }
        return $rel;
    }
}
