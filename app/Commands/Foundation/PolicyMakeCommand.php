<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\PolicyMakeCommand as PolicyMake;
use App\Commands\Helpers\PackageDetail;
use Illuminate\Support\Str;

class PolicyMakeCommand extends PolicyMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:policy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Policy for your package';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        app()['config']->set('auth.providers.users.model', $this->namespaceFromComposer() . 'User');

        return $this->option('model')
            ? __DIR__ . '/stubs/policy.stub'
            : __DIR__ . '/stubs/policy.plain.stub';
    }

    /**
     * Replace the model for the given stub.
     *
     * @param  string  $stub
     * @param  string  $model
     * @return string
     */
    protected function replaceModel($stub, $model)
    {
        $model = str_replace('/', '\\', $model);

        $namespaceModel = $this->namespaceFromComposer() . $model;

        if (Str::startsWith($model, '\\')) {
            $stub = str_replace('NamespacedDummyModel', trim($model, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyModel', $namespaceModel, $stub);
        }

        $stub = str_replace(
            "use {$namespaceModel};\nuse {$namespaceModel};",
            "use {$namespaceModel};",
            $stub
        );

        $model = class_basename(trim($model, '\\'));

        $dummyUser = class_basename(config('auth.providers.users.model'));

        $dummyModel = Str::camel($model) === 'user' ? 'model' : $model;

        $stub = str_replace('DocDummyModel', Str::snake($dummyModel, ' '), $stub);

        $stub = str_replace('DummyModel', $model, $stub);

        $stub = str_replace('dummyModel', Str::camel($dummyModel), $stub);

        $stub = str_replace('DummyUser', $dummyUser, $stub);

        return str_replace('DocDummyPluralModel', Str::snake(Str::plural($dummyModel), ' '), $stub);
    }
}
