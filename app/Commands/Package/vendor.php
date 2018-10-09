<?php

namespace App\Commands\Package;

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
        $last_section = '];';

        $to_replace = '"vendor" => "' . $this->argument('value') . '",
        ];';
        $content = str_replace($last_section, $to_replace, $app_config);

        file_put_contents(config_path('package.php'), $content);
    }
}
