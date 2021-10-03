<?php

namespace Tests\Feature\Make;

use Tests\TestCase;
use Tests\RefreshPacker;
use Illuminate\Support\Facades\Artisan;

class ModelTest extends TestCase
{
    use RefreshPacker;

    public function test_it_create_model_file()
    {
        Artisan::call('make:model User');
        $this->isFileExists('src/models/User.php');
        $content = file_get_contents($this->_testPath() . 'src/models/User.php');
        $this->assertStringContainsString('namespace Bitfumes\TestApp\Models;', $content);
        $this->assertStringContainsString('class User extends Model', $content);
    }
}
