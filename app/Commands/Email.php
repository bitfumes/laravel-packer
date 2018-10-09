<?php

namespace App\Commands;

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

        $to_replace = "'email' => '" . $this->argument('value') . "',";
        $content = preg_replace('/\'email\'.+\=\>.+,?/', $to_replace, $app_config);

        file_put_contents(config_path('package.php'), $content);
    }
}
