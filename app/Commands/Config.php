<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Config extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'check:config';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Gives you information (if) you have saved for packer.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (config('package.author')) {
            $this->info('Your have set author name as: ' . config('package.author'));
        } else {
            $this->error('No value author name, try to use packer set:author {author_name}');
        }

        if (config('package.email')) {
            $this->info('Your have set author email as: ' . config('package.email'));
        } else {
            $this->error('No value author email, try to use packer set:email {email_address}');
        }

        if (config('package.vendor')) {
            $this->info('Your have set vendor name as: ' . config('package.vendor'));
        } else {
            $this->error('No value vendor name, try to use packer set:vendor {vendor_name}');
        }
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
