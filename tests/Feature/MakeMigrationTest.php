<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\RefreshPacker;
use Illuminate\Support\Facades\Artisan;

class MakeMigrationTest extends TestCase
{
    use RefreshPacker;

    public function test_it_can_test_migration_command_on_non_laravel_dir()
    {
        Artisan::call('make:migration CreateTestsTable');
        $this->assertEquals(1, count(glob($this->_testPath() . 'src/database/migrations/*_create_tests_table.php')));
    }
}
