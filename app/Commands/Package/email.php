<?php

namespace App\Commands\Package;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Email extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'set:email {value}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'It can set package author email on packer config';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $app_config = file_get_contents(config_path('package.php'));
        $last_section = '];';

        $to_replace = '"email" => "' . $this->argument('value') . '",
        ];';
        $content = str_replace($last_section, $to_replace, $app_config);

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
