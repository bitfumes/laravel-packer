<?php

namespace Tests\Feature\Make;

use Tests\TestCase;
use Tests\RefreshPacker;
use Illuminate\Support\Facades\Artisan;

class FactoryTest extends TestCase
{
    use RefreshPacker;

    public function test_it_create_class_based_factory()
    {
        Artisan::call('make:factory TestFactory --model Test');
        $this->isFileExists('src/database/factories/TestFactory.php');
        $content = file_get_contents($this->_testPath() . 'src/database/factories/TestFactory.php');
        $this->assertStringContainsString('protected $model = Test::class;', $content);
        $this->assertStringContainsString('use Bitfumes\TestApp\Test;', $content);
        $this->assertStringContainsString('namespace Bitfumes\TestApp\Database\Factories;', $content);
    }
}
