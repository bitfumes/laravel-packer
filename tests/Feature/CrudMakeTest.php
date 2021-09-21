<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class CrudMakeTest extends TestCase
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
        // echo shell_exec("rm -r $path");
    }

    public function test_it_can_create_a_json_file_to_write_crud_structure()
    {
        Artisan::call('crud:json Test');
        $this->isFileExists('crud/Test.json');
    }

    public function test_it_can_create_a_crud_for_a_json_file()
    {
        Artisan::call('crud:json Test');
        Artisan::call('crud:make crud/Test.json');
        $this->isFileExists('src/Test.php');
        $this->isFileExists('src/database/factories/TestFactory.php');
        $this->isFileExists('src/Http/controllers/TestController.php');
        $this->isFileExists('tests/Feature/TestTest.php');
        $this->isFileExists('tests/Unit/TestTest.php');
    }

    public function isFileExists($filename)
    {
        return $this->assertFileExists(base_path() . '/package/TestApp/' . $filename);
    }
}
