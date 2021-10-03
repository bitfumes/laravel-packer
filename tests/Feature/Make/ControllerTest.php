<?php

namespace Tests\Feature\Make;

use Tests\TestCase;
use Tests\RefreshPacker;
use Illuminate\Support\Facades\Artisan;

class ControllerTest extends TestCase
{
    use RefreshPacker;

    public function test_it_create_controller_file()
    {
        Artisan::call('make:controller TestController');
        $this->isFileExists('src/Http/Controllers/TestController.php');
        $content = file_get_contents($this->_testPath() . 'src/Http/Controllers/TestController.php');
        $this->assertStringContainsString('TestController', $content);
    }
}
