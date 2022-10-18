<?php

namespace Despawn\Console\Commands;

use Despawn\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Silber\Bouncer\BouncerFacade as Bouncer;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'despawn:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets up the default categories and boards for the installation.';

    public function handle()
    {
        $this->comment('Setting up default forums...');

        DB::transaction(fn () => $this->createModels(), 3);

        $this->comment('Setting up default roles...');

        DB::transaction(fn () => $this->createRoles(), 3);

        $this->comment('Despawn default forums setup!');
    }

    private function createModels()
    {
        $categoryOfficial = Category::create([
            'title' => 'Official',
            'description' => 'Official forums dedicated to announcements, news, information and feedback.',
        ]);

        $categoryOfficial->boards()->create([
            'title' => 'Announcements',
            'description' => 'Here you will find news, information and updates related to the site.',
        ]);

        $categoryOfficial->boards()->create([
            'title' => 'Feedback and Suggestions',
            'description' => 'Leave feedback or post suggestions to improve the site\'s quality.',
            'weight' => 2,
        ]);

        $categoryGeneral = Category::create([
            'title' => 'General Discussions',
            'description' => 'An all rounded area with a number of topics and discussions, if it doesn\'t have a section, check here.',
            'weight' => 2,
        ]);

        $categoryGeneral->boards()->create([
            'title' => 'The Lounge',
            'description' => 'For the general chit-chats. You can post stuff in here that has nothing to do with forums.',
        ]);

        $categoryGeneral->boards()->create([
            'title' => 'Introductions',
            'description' => 'New to the forums? Please introduce yourself here! We\'d love to know who you are!',
            'weight' => 2,
        ]);
    }

    private function createRoles()
    {
        $superadmin = Bouncer::role()->firstOrCreate([
            'name' => 'superadmin',
            'title' => 'Super Admin',
            'level' => 999
        ]);

        $banned = Bouncer::role()->firstOrCreate([
            'name' => 'banned',
            'title' => 'Banned',
        ]);

        Bouncer::role()->firstOrCreate([
            'name' => 'user',
            'title' => ' User',
        ]);

        Bouncer::allow($superadmin)->everything();

        Bouncer::forbid($banned)->everything();
    }
}
