<?php

namespace Despawn\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'despawn:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs Despawn and performs database setup.';

    public function handle()
    {
        $this->comment('Publishing fresh assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'despawn-assets']);
    }
}
