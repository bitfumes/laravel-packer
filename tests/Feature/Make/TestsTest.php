<?php

namespace Tests\Feature\Make;

use Tests\TestCase;
use Tests\RefreshPacker;
use Illuminate\Support\Facades\Artisan;

class TestsTest extends TestCase
{
    use RefreshPacker;

    public function test_it_create_feature_test_file()
    {
        Artisan::call('make:test UserTest');
        $this->isFileExists('tests/feature/UserTest.php');
        $content = file_get_contents($this->_testPath() . 'tests/feature/UserTest.php');
        $this->assertStringContainsString('class UserTest extends TestCase', $content);
    }

    public function test_it_create_unit_test_file()
    {
        Artisan::call('make:test UserTest --unit');
        $this->isFileExists('tests/unit/UserTest.php');
        $content = file_get_contents($this->_testPath() . 'tests/unit/UserTest.php');
        $this->assertStringContainsString('class UserTest extends TestCase', $content);
    }
}
