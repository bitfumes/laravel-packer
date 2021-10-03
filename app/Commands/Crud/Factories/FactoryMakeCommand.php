<?php

namespace App\Commands\Crud\Factories;

use Illuminate\Support\Str;
use App\Commands\Helpers\PackageDetail;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class FactoryMakeCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:factory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new model factory';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Factory';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/factory.stub';
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $factory = class_basename(Str::ucfirst(str_replace('Factory', '', $name)));

        $namespaceModel = $this->option('model')
                        ? $this->qualifyModel($this->option('model'))
                        : $this->qualifyModel($this->guessModelName($name));

        $model = class_basename($namespaceModel);

        if (Str::startsWith($namespaceModel, $this->rootNamespace() . 'Models')) {
            $namespace = Str::beforeLast('Database\\Factories\\' . Str::after($namespaceModel, $this->rootNamespace() . 'Models\\'), '\\');
        } else {
            $namespace = $this->rootNamespace() . 'Database\\Factories';
        }

        $replace = [
            '{{ factoryNamespace }}' => $namespace,
            'NamespacedDummyModel'   => $namespaceModel,
            '{{ namespacedModel }}'  => $namespaceModel,
            '{{namespacedModel}}'    => $namespaceModel,
            'DummyModel'             => $model,
            '{{ model }}'            => $model,
            '{{model}}'              => $model,
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name    = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path    = getcwd() . $this->devPath();
        $path    = $this->getComposer()->type !== 'project' ? $path . 'src/' : $path;
        return $path . '/database/factories/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The name of the model'],
        ];
    }

    public function addFakerData($factory)
    {
        $fields   = cache()->get('structure')->fields;
        $newLines = '';
        foreach ($fields as $field) {
            foreach ($this->fakerType() as $key => $value) {
                // dump($field->type);
                if ($key == $field->type) {
                    $newLines .= "'$field->name'" . ' => $faker->' . $value . ',
        ';
                }
            }
        }
        return str_replace('//', $newLines, $factory);
    }

    protected function fakerType()
    {
        return [
            'string'             => 'word',
            'text'               => 'paragraph',
            'integer'            => 'numberBetween(1,100)',
            'bigInteger'         => 'numberBetween(1,100)',
            'unsignedBigInteger' => 'numberBetween(1,100)',
            'unsignedInteger'    => 'numberBetween(1,100)',
            'boolean'            => 'boolean()',
            'dateTime'           => 'dateTime()',
        ];
    }
}
