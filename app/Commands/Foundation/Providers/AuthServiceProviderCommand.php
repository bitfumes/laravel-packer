<?php

namespace App\Commands\Foundation\Providers;

use Illuminate\Foundation\Console\ProviderMakeCommand as ProviderMake;
use App\Commands\Helpers\PackageDetail;


class AuthServiceProviderCommand extends ProviderMake
{
    use PackageDetail;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $name = 'make:auth-provider';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Creates an auth service provider for your package';

    protected function getStub()
    {
        return __DIR__ . '/../stubs/providers/auth.stub';
    }
}
