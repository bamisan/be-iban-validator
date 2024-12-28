<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProjectInitializationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'initialize:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->warn('dropping all tables from the database and then executing the migrate command');
        Artisan::call('migrate:fresh');
        $this->info(Artisan::output());

        $this->warn('Seeding DB');
        Artisan::call('db:seed');
        $this->info(Artisan::output());

        $users = User::all()->map(function ($user) {
            return [
                'name' => $user->name,
                'email' => $user->email,
                'password' => 'Iban@2025',
            ];
        });

        $this->table(
            ['Email', 'Password'],
            $users->toArray()
        );
    }
}
