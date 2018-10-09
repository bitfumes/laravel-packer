<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\ObserverMakeCommand as ObserverMake;
use App\Commands\Helpers\PackageDetail;

class ObserverMakeCommand extends ObserverMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:observer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Observer class in your package';
}
