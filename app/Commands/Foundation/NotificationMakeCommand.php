<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\NotificationMakeCommand as NotificationMake;
use App\Commands\Helpers\PackageDetail;

class NotificationMakeCommand extends NotificationMake
{
    use PackageDetail;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Notification class in your package';
}
