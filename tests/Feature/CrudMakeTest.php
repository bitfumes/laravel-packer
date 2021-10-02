<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\RefreshPacker;
use Illuminate\Support\Facades\Artisan;

class CrudMakeTest extends TestCase
{
    use RefreshPacker;

    public function test_it_can_create_a_json_file_to_write_crud_structure()
    {
        Artisan::call('crud:json Test');
        $this->isFileExists('crud/Test.json');
    }

    public function test_it_can_create_a_crud_for_a_json_file()
    {
        Artisan::call('crud:json Test');
        Artisan::call('crud:make Test');
        $this->isFileExists('src/Test.php');
        $this->isFileExists('src/database/factories/TestFactory.php');
        $this->assertEquals(1, count(glob($this->_testPath() . 'src/database/migrations/*_create_tests_table.php')));
        $this->isFileExists('src/Http/controllers/TestController.php');
        $this->isFileExists('tests/Feature/TestTest.php');
        $this->isFileExists('tests/Unit/TestTest.php');
    }
}
