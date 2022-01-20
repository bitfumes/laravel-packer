<?php

namespace App\Commands\Foundation\Migrations;

use Illuminate\Filesystem\Filesystem;
use App\Commands\Helpers\PackageDetail;
use Illuminate\Database\Migrations\MigrationCreator as RealMigrationCreator;

class MigrationCreator extends RealMigrationCreator
{
    use PackageDetail;

    public function __construct(Filesystem $files, $customStubPath = __DIR__ . '/stubs')
    {
        parent::__construct($files, $customStubPath);
    }

    /**
     * Get the full path to the migration.
     *
     * @param  string  $name
     * @param  string  $path
     * @return string
     */
    protected function getPath($name, $path)
    {
        $devPath = '';
        if (app()->environment() === 'development') {
            $devPath = $this->devPath() . 'src/';
        }
        
        $path = getcwd() . $devPath . DIRECTORY_SEPARATOR .'database' . DIRECTORY_SEPARATOR . 'migrations';

        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true);
        }

        return $path . '/' . $this->getDatePrefix() . '_' . $name . '.php';
    }
}
