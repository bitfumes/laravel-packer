<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Command
    |--------------------------------------------------------------------------
    |
    | Laravel Zero will always run the command specified below when no command name is
    | provided. Consider update the default command for single command applications.
    | You cannot pass arguments to the default command because they are ignored.
    |
    */

    'default' => NunoMaduro\LaravelConsoleSummary\SummaryCommand::class,

    /*
    |--------------------------------------------------------------------------
    | Commands Paths
    |--------------------------------------------------------------------------
    |
    | This value determines the "paths" that should be loaded by the console's
    | kernel. Foreach "path" present on the array provided below the kernel
    | will extract all "Illuminate\Console\Command" based class commands.
    |
    */

    'paths' => [app_path('Commands')],

    /*
    |--------------------------------------------------------------------------
    | Added Commands
    |--------------------------------------------------------------------------
    |
    | You may want to include a single command class without having to load an
    | entire folder. Here you can specify which commands should be added to
    | your list of commands. The console's kernel will try to load them.
    |
    */

    'add' => [
        // ..
    ],

    /*
    |--------------------------------------------------------------------------
    | Hidden Commands
    |--------------------------------------------------------------------------
    |
    | Your application commands will always be visible on the application list
    | of commands. But you can still make them "hidden" specifying an array
    | of commands below. All "hidden" commands can still be run/executed.
    |
    */

    'hidden' => [
        NunoMaduro\LaravelConsoleSummary\SummaryCommand::class,
        Symfony\Component\Console\Command\HelpCommand::class,
        Illuminate\Console\Scheduling\ScheduleRunCommand::class,
        Illuminate\Console\Scheduling\ScheduleFinishCommand::class,
        Illuminate\Foundation\Console\VendorPublishCommand::class,

        // Custom hidden commands
        App\Commands\Standalone\Codecov::class,
        App\Commands\Standalone\Composer::class,
        App\Commands\Standalone\Config::class,
        App\Commands\Standalone\Contributing::class,
        App\Commands\Standalone\Gitignore::class,
        App\Commands\Standalone\Gitattributes::class,
        App\Commands\Standalone\License::class,
        App\Commands\Standalone\Phpunit::class,
        App\Commands\Standalone\Readme::class,
        App\Commands\Standalone\ServiceProvider::class,
        App\Commands\Standalone\StyleCI::class,
        App\Commands\Standalone\Travis::class,

        App\Commands\TestDir\FeatureTest::class,
        App\Commands\TestDir\Testcase::class,
        App\Commands\TestDir\UnitTest::class,

        App\Commands\Author::class,
        App\Commands\Email::class,
        App\Commands\Vendor::class,
        App\Commands\Config::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Removed Commands
    |--------------------------------------------------------------------------
    |
    | Do you have a service provider that loads a list of commands that
    | you don't need? No problem. Laravel Zero allows you to specify
    | below a list of commands that you don't to see in your app.
    |
    */

    'remove' => [
        Illuminate\Database\Console\Migrations\FreshCommand::class,
        Illuminate\Database\Console\Migrations\RefreshCommand::class,
        Illuminate\Database\Console\Migrations\InstallCommand::class,
        Illuminate\Database\Console\Migrations\ResetCommand::class,
        Illuminate\Database\Console\Migrations\RollbackCommand::class,
        Illuminate\Database\Console\Migrations\StatusCommand::class,
        Illuminate\Database\Console\Migrations\MigrateCommand::class,
    ],
];
