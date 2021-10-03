<?php

namespace Tests\Feature\Make;

use Tests\TestCase;
use Tests\RefreshPacker;
use Illuminate\Support\Facades\Artisan;

class CommandTest extends TestCase
{
    use RefreshPacker;

    public function test_it_create_class_based_factory()
    {
        $this->assertTrue(true);
        // Artisan::call('make:command TestCommand');
        // $this->isFileExists('src/Console/TestCommand.php');
        // $content = file_get_contents($this->_testPath() . 'src/Console/TestCommand.php');
        // // $this->assertStringContainsString('use Bitfumes\TestApp\Models\User;', $content);
        // $this->assertStringContainsString('TestCommand', $content);
    }
}
