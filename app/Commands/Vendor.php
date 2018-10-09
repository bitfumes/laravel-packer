<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Vendor extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'set:vendor {value}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'It can set package vendor name on packer config';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $app_config = file_get_contents(config_path('package.php'));

        $to_replace = "'vendor' => '" . $this->argument('value') . "',";
        $content = preg_replace('/\'vendor\'.+\=\>.+,/', $to_replace, $app_config);

        file_put_contents(config_path('package.php'), $content);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
