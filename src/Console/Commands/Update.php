<?php

namespace Despawn\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Update extends Command
{
    protected $signature = 'despawn:update';

    protected $description = 'Publishes fresh Despawn assets.';

    public function handle()
    {
        $this->comment('Publishing fresh assets..');

        File::deleteDirectory(realpath(public_path('vendor/despawn/build')));

        $this->call('vendor:publish', [
            '--tag' => 'despawn-assets',
            '--force' => true,
        ]);

        $this->comment('Despawn assets updated!');
    }
}
