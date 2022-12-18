<?php

namespace Despawn\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Update extends Command
{
    protected $signature = 'despawn:update';

    protected $description = 'Publishes fresh Despawn assets.';

    public function handle()
    {
        $this->comment('Publishing fresh assets..');

        Storage::disk('local')->deleteDirectory(public_path('vendor/despawn'));

        $this->call('vendor:publish', [
            '--tag' => 'despawn-assets',
            '--force' => true,
        ]);
        $this->comment('Despawn assets updated!');
    }
}
