<?php

namespace App\Commands\Package;

use LaravelZero\Framework\Commands\Command;

class User extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'set:user {value}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'It can set package author name on Packer config';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $app_config = file_get_contents(config_path('package.php'));
        $last_section = '];';

        $to_replace = '"user" => "' . $this->argument('value') . '",
        ];';
        $content = str_replace($last_section, $to_replace, $app_config);

        file_put_contents(config_path('package.php'), $content);
    }
}
