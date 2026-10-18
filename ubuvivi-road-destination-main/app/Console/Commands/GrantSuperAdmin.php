<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GrantSuperAdmin extends Command
{
    protected $signature = 'admin:grant-super-admin {email : Email address of the existing account} {--force : Skip the confirmation prompt}';

    protected $description = 'Promote an existing user account to super admin';

    public function handle()
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error('No active user account was found for that email address.');
            return 1;
        }

        if ($user->isSuperAdmin()) {
            $this->info('This account is already a super admin.');
            return 0;
        }

        if (!$this->option('force') && !$this->confirm('Promote ' . $user->email . ' to super admin?')) {
            $this->info('No changes were made.');
            return 1;
        }

        $user->role = User::ROLE_SUPER_ADMIN;
        $user->save();

        $this->info('Account promoted to super admin.');
        return 0;
    }
}
