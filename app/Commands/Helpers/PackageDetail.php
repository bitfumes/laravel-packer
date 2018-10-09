<?php

namespace App\Commands\Helpers;

use Illuminate\Support\Str;

trait PackageDetail
{
    protected function getComposer()
    {
        $dev_path = app()->environment() == 'development' ? '/package/liker' : '';
        $path = getcwd() . $dev_path . '/composer.json';
        return json_decode(file_get_contents($path));
    }

    public function namespaceFromComposer()
    {
        if (cache()->has('namespaceFromComposer')) {
            return cache()->get('namespaceFromComposer');
        }
        $content = $this->getComposer();
        $psr = 'psr-4';
        cache()->forever('namespaceFromComposer', key($content->autoload->$psr));
        return key($content->autoload->$psr);
    }

    protected function getVendor()
    {
        return str_before($this->namespaceFromComposer(), '\\');
    }

    protected function getPackageName()
    {
        return str_replace('\\', '', str_after($this->namespaceFromComposer(), '\\'));
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->namespaceFromComposer();
    }

    public function devPath()
    {
        return (app()->environment() == 'development') ? '/package/' . $this->getPackageName() : '';
    }

    public function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        $path = getcwd() . $this->devPath() . '/src/';
        return $path . str_replace('\\', '/', $name) . '.php';
    }
}
