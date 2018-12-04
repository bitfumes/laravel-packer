<?php

namespace App\Commands\Foundation\Migrations;

use Illuminate\Database\Migrations\MigrationCreator as RealMigrationCreator;
use App\Commands\Helpers\PackageDetail;

class MigrationCreator extends RealMigrationCreator
{
    use PackageDetail;

    /**
     * Get the full path to the migration.
     *
     * @param  string  $name
     * @param  string  $path
     * @return string
     */
    protected function getPath($name, $path)
    {
        $path = getcwd() . $this->devPath() . '/src/database/migrations';
        if (!$this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true);
        }

        return $path . '/' . $this->getDatePrefix() . '_' . $name . '.php';
    }
}
