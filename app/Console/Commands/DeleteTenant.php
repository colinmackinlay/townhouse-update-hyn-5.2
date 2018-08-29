<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Illuminate\Console\Command;

class DeleteTenant extends Command
{
    protected $signature = 'tenant:delete {name}';
    protected $description = 'Deletes a tenant of the provided name. Only available on the local environment e.g. php artisan tenant:delete boise';

    public function handle()
    {
        // because this is a destructive command, we'll only allow to run this command
        // if you are on the local environment
        if (!app()->isLocal()) {
            $this->error('This command is only available on the local environment.');

            return;
        }

        $name = $this->argument('name');
        $result = Tenant::delete($name);
        $this->info($result);
    }
}
