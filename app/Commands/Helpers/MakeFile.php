<?php

namespace App\Commands\Helpers;

use LaravelZero\Framework\Commands\Command;
use Illuminate\Filesystem\Filesystem;

abstract class MakeFile extends Command
{
    abstract public function getStub();

    abstract public function getFilename();

    abstract public function getPath();

    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    /**
         * Execute the console command.
         *
         * @return mixed
         */
    public function handle()
    {
        $this->makeFile();
    }

    protected function makeFile()
    {
        $this->makeDir();
        // if (!$this->filesystem->isFile($this->getPath() . '/' . $this->getFilename())) {
        return $this->filesystem->put($this->getPath() . '/' . $this->getFilename(), $this->getReplaceContent());
        // }
    }

    /**
     * @return bool
     */
    protected function makeDir()
    {
        if (!$this->filesystem->isDirectory($this->getPath())) {
            return $this->filesystem->makeDirectory($this->getPath(), 0755, true);
        }
    }

    protected function getContent()
    {
        return $this->filesystem->get($this->getStub());
    }

    protected function getReplaceContent()
    {
        $content = $this->getContent();
        $content = str_replace(
                $this->stringsToReplace(),
                $this->replaceContent(),
                $content
            );

        return $content;
    }

    protected function stringsToReplace()
    {
        return [
            'LowerCaseDumyVendor',
            'LowerCaseDummyPackageName',
            'StudlyDummyVendor',
            'StudlyDummyPackageName',
            'KebabDummyVendor',
            'KebabDummyPakageName',
            'DummyAuthorName',
            'DummyAuthorEmail'
        ];
    }

    protected function replaceContent()
    {
        $vendor = cache()->get('vendor');
        $packageName = cache()->get('package_name');
        return [
            strtolower($vendor),
            strtolower($packageName),
            studly_case($vendor),
            studly_case($packageName),
            $vendor,
            $packageName,
            cache()->get('author_name'),
            cache()->get('author_email'),
        ];
    }
}
