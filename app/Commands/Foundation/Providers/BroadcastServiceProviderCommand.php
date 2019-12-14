<?php

namespace App\Commands\Foundation\Providers;

use Illuminate\Foundation\Console\ProviderMakeCommand as ProviderMake;
use App\Commands\Helpers\PackageDetail;

class BroadcastServiceProviderCommand extends ProviderMake
{
    use PackageDetail;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $name = 'make:provider:broadcast';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Creates a broadcast service provider for your package';

    protected function getStub()
    {
        return __DIR__ . '/../stubs/providers/broadcast.stub';
    }
}
