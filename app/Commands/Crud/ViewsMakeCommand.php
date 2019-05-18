<?php

namespace App\Commands\Crud;

use Illuminate\Console\GeneratorCommand;
use App\Commands\Helpers\PackageDetail;

class ViewsMakeCommand extends GeneratorCommand
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'crud:views';

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

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->callSilent('crud:addRoute', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:layout.app', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:layout.flash', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:view.index', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:view.create', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:view.edit', [
            'name' => $this->argument('name')
        ]);

        $this->callSilent('crud:view.show', [
            'name' => $this->argument('name')
        ]);
    }

    protected function getStub()
    {
        return '/../stubs/views/index.stub';
    }
}
