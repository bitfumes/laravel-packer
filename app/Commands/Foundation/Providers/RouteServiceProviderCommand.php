<?php

namespace App\Commands\Foundation\Providers;

use Illuminate\Foundation\Console\ProviderMakeCommand as ProviderMake;
use App\Commands\Helpers\PackageDetail;

class RouteServiceProviderCommand extends ProviderMake
{
    use PackageDetail;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $name = 'make:route-provider';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Creates a route service provider for your package';

    protected function getStub()
    {
        return __DIR__ . '/../stubs/providers/route.stub';
    }
}