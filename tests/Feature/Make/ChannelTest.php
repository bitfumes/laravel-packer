<?php

namespace Tests\Feature\Make;

use Tests\TestCase;
use Tests\RefreshPacker;
use Illuminate\Support\Facades\Artisan;

class ChannelTest extends TestCase
{
    use RefreshPacker;

    public function test_it_create_class_based_factory()
    {
        Artisan::call('make:channel TestChannel');
        $this->isFileExists('src/Broadcasting/TestChannel.php');
        $content = file_get_contents($this->_testPath() . 'src/Broadcasting/TestChannel.php');
        $this->assertStringContainsString('use Bitfumes\TestApp\Models\User;', $content);
        $this->assertStringContainsString('TestChannel', $content);
    }
}
