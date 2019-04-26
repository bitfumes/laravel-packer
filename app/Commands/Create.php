<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Cache;

class Create extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'new {name?} {vendor?} {author_name?} {author_email?} {path?}';

    /**
     * The description of the command.
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create scaffolding of your package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->task('Managing package details', function () {
            $this->setArguments();
        });
        $this->task('Creating helper files', function () {
            $this->callSilent('create:readme');
            $this->callSilent('create:composer');
            $this->callSilent('create:phpunit');
            $this->callSilent('create:license');
            $this->callSilent('create:contributing');
            $this->callSilent('create:styleci');
            $this->callSilent('create:codecov');
            $this->callSilent('create:gitignore');
            $this->callSilent('create:gitattributes');
            $this->callSilent('create:travis');
            $this->callSilent('create:facade');
        });

        $this->task('Creating Service Provider for package', function () {
            $this->callSilent('create:provider');
        });

        $this->task('Creating tests directory and test files', function () {
            $this->callSilent('create:testcase');
            $this->callSilent('create:featuretest');
            $this->callSilent('create:unittest');
        });

        $this->task('Creating configuration file', function () {
            $this->callSilent('create:config');
        });

        $this->initializeGit();
    }

    protected function setArguments()
    {
        $this->setVendor();
        $this->setPackageName();
        $this->setAuthorName();
        $this->setAuthorEmail();
        $this->setPath();
    }

    protected function setAuthorName()
    {
        $argument = $this->argument('author_name');
        if (!$argument) {
            if (config('package.user')) {
                $argument = config('package.user');
            } else {
                $argument = $this->ask('Enter package author name');
            }
        }
        Cache::forever('author_name', trim($argument));
    }

    protected function setAuthorEmail()
    {
        $argument = $this->argument('author_email');
        if (!$argument) {
            if (config('package.email')) {
                $argument = config('package.email');
            } else {
                $argument = $this->ask('Enter package author email');
            }
        }
        Cache::forever('author_email', trim($argument));
    }

    /**
     * @return mixed|string
     */
    protected function setVendor()
    {
        $argument = $this->argument('vendor');
        if (!$argument) {
            if (config('package.vendor')) {
                $argument = config('package.vendor');
            } else {
                $argument = $this->ask('Enter your vendor name');
            }
        }
        Cache::forever('vendor', kebab_case($argument));
    }

    /**
     * @return array|mixed|null|string
     */
    protected function setPackageName()
    {
        $argument = $this->argument('name');
        if (!$argument) {
            $argument = $this->ask('Enter your package name');
        }
        Cache::forever('package_name', kebab_case($argument));
    }

    /**
     * @return string
     */
    protected function setPath()
    {
        $path         = $this->argument('path') ? $this->argument('path') : getcwd();
        $path         = app()->environment() == 'development' ? $path . '/package' : $path;
        $package_name = studly_case(cache()->get('package_name'));
        Cache::forever('package_path', "{$path}/{$package_name}");
    }

    protected function initializeGit()
    {
        $path         = $this->argument('path') ? $this->argument('path') : getcwd();
        $path         = app()->environment() == 'development' ? $path . '/package' : $path;
        $package_name = studly_case(cache()->get('package_name'));
        chdir("{$path}/{$package_name}");
        $this->info(shell_exec('git init'));
    }
}
