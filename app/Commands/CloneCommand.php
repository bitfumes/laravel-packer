<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

class CloneCommand extends Command
{
    protected $repo;

    protected $dir;

    protected $branch;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'clone 
                            {repository : The repository url you want to clone} 
                            {dir? : Specify directory name to which you want to clone the repository}
                            {--B|branch= : Specify branch you want to clone, default is master}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Clone any laravel repository, Install composer and generate key';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->setAttributes();

        $this->cloneRepo();

        $this->installComposer();

        $this->installNpm();
    }

    public function setAttributes()
    {
        $this->repo   = $this->argument('repository');
        $this->branch = $this->option('branch');
        $dir          = $this->argument('dir') ? $this->argument('dir') : $this->getRepoName($this->repo);
        $this->dir    = getcwd() . '/' . $dir;
    }

    public function cloneRepo()
    {
        $command = "git clone {$this->repo}";

        if ($this->branch) {
            $this->info("Using branch {$this->branch}");
            $command = "git clone -b {$this->branch} {$this->repo}";
        }
        $command = "{$command} {$this->dir}";
        $this->info(shell_exec($command));
    }

    public function installComposer()
    {
        if (file_exists($this->dir . '/composer.json')) {
            $this->info('Installing Composer...');
            $composer = $this->findComposer();
            $command  = $composer . ' install';
            chdir("{$this->dir}");

            $this->info(shell_exec($command));

            if (strtolower($this->readType()) == 'project') {
                $this->keyGenerate();
            }
        }
    }

    public function keyGenerate()
    {
        $this->info('Generating Key...');
        chdir("{$this->dir}");
        exec('cp .env.example .env');
        $this->info(shell_exec('php artisan key:generate'));
    }

    public function getRepoName()
    {
        $basename = exec("basename {$this->repo}");
        return str_replace('.git', '', $basename);
    }

    /**
     * Get the composer command for the environment.
     *
     * @return string
     */
    protected function findComposer()
    {
        if (file_exists(getcwd() . '/composer.phar')) {
            return '"' . PHP_BINARY . '" composer.phar';
        }

        return 'composer';
    }

    public function readType()
    {
        $content = $this->getComposerFile();
        if (isset($content->type)) {
            return $content->type;
        }
        return;
    }

    protected function getComposerFile()
    {
        $path = $this->dir . '/composer.json';
        return json_decode(file_get_contents($path));
    }

    protected function installNpm()
    {
        if (file_exists($this->dir . '/package.json') || file_exists($this->dir . '/yarn.json')) {
            if ($this->confirm('Do you want to install npm')) {
                chdir("{$this->dir}");
                $this->info(shell_exec('npm install'));
            }
        }
    }
}
