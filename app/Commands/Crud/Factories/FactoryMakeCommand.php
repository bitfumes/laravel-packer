<?php

namespace App\Commands\Crud\Factories;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use App\Commands\Helpers\PackageDetail;
use Illuminate\Support\Str;

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
        $model = $this->option('model')
            ? $this->qualifyClass($this->option('model'))
            : 'Model';

        $factory = parent::buildClass($name);

        $factory = $this->addFakerData($factory);

        return str_replace(
            'DummyModel',
            $model,
            $factory
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
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path = getcwd() . $this->devPath() . '/src/';
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
            'dateTime'           => 'dateTime()'
        ];
    }
}
