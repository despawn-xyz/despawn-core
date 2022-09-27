<?php

namespace Despawn\Console\Commands;

use Illuminate\Console\Command;

class Update extends Command
{
    protected $signature = 'despawn:update';

    protected $description = 'Publishes fresh Despawn assets.';

    public function handle()
    {
        $this->comment('Publishing fresh assets..');
        $this->call('vendor:publish', [
            '--tag' => 'despawn-assets',
            '--force' => true,
        ]);
        $this->comment('Despawn assets updated!');
    }
}
