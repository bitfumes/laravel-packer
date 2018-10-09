<?php

namespace App\Commands\Foundation;

use Illuminate\Foundation\Console\MailMakeCommand as MailMake;
use App\Commands\Helpers\PackageDetail;

class MailMakeCommand extends MailMake
{
    use PackageDetail;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new email class';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('markdown')
            ? __DIR__ . '/stubs/markdown-mail.stub'
            : __DIR__ . '/stubs/mail.stub';
    }
}
