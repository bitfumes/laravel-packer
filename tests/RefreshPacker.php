<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;

trait RefreshPacker
{
    public function setUp():void
    {
        parent::setUp();
        Artisan::call('new TestApp Bitfumes Sarthaks sarthak@bitfumes.com laravel,test');
        chdir(base_path());
    }

    public function tearDown():void
    {
        parent::tearDown();
        $path  = base_path() . '/package';
        echo shell_exec("rm -r $path");
    }

    public function isFileExists($filename)
    {
        return $this->assertFileExists(base_path() . '/package/TestApp/' . $filename);
    }
}
