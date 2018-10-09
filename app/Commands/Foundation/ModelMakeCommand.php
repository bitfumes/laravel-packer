<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\ModelMakeCommand as ModelMake;
use App\Commands\Helpers\PackageDetail;

class ModelMakeCommand extends ModelMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class in your package';
}
