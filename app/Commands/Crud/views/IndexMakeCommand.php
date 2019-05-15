<?php

namespace App\Commands\Crud\Views;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use App\Commands\Helpers\PackageDetail;

class IndexMakeCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:view.index';

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


    protected function getStub()
    {
        return __DIR__ . '/../stubs/views/index.stub';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->namespaceFromComposer() . 'resources/views';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    public function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path = getcwd() . $this->devPath() . '/src/resources/views/' . strtolower($this->argument('name'));
        return $path . '/index.blade.php';
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
        $stub = str_replace(
            [
                '//FIELDS_TH',
                '//VALUES_TD',
                'DummyModelName',
                'DummyModelLower',
                'DummyModelPlural',
                'DummyPackageName::'
            ],
            [
                $this->createFields(),
                $this->createValues(),
                $this->argument('name'),
                strtolower($this->argument('name')),
                Str::plural(strtolower($this->argument('name'))),
                $this->replaceLayout()
            ],
            $stub
        );

        return $this;
    }

    public function replaceLayout()
    {
        $content = $this->getComposer();
        return $content->type == 'library' ? strtolower($this->getPackageName()) . '::' : '';
    }

    public function createFields()
    {
        $fields = cache()->get('structure')->fields;
        $th = '';
        foreach ($fields as $field) {
            $th .= "<th>{$field->name}</th>
                    ";
        }
        return $th;
    }

    public function createValues()
    {
        $fields = cache()->get('structure')->fields;
        $model = strToLower($this->argument('name'));
        $td = '';
        foreach ($fields as $field) {
            $td .= '<td>{{ $' . $model . "->{$field->name} }}</td>
                    ";
        }
        return $td;
    }
}
