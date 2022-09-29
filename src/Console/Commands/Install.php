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
        $this->comment('Creating database...');

        $this->setupDatabase();
        $this->publishAssets();

        $this->callSilent('key:generate', [
            '--force' => true
        ]);

        $this->comment('Despawn is now ready to use. Enjoy!');
    }

    private function setupDatabase()
    {
        $databasePath = database_path('database.sqlite');

        if (config('database.default') === 'sqlite') {
            if (! file_exists($databasePath)) {
                touch($databasePath);

                $this->comment('Database created.');
            }
        }

        $this->call('migrate', [
            '--force' => true
        ]);
    }

    private function publishAssets()
    {
        $this->comment('Publishing fresh assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'despawn-assets']);

    }

    protected function setKeyInEnvironmentFile($key, $currentKey)
    {
        if (strlen($currentKey) !== 0 && (! $this->confirmToProceed())) {
            return false;
        }

        $this->writeNewEnvironmentFileWith($key, 'APP_KEY=');

        return true;
    }

    /**
     * Write a new environment file with the given key.
     *
     * @param  string  $key
     * @return void
     */
    protected function writeNewEnvironmentFileWith($key, $identifier)
    {
        file_put_contents($this->laravel->environmentFilePath(), preg_replace(
            $this->keyReplacementPattern(),
            $identifier.'='.$key,
            file_get_contents($this->laravel->environmentFilePath())
        ));
    }
}
