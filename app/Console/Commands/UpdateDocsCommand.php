<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateDocsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the documentation.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Updating documentation...');

        $repository = config('docs.repository');
        $branch = config('docs.branch');
        $accessToken = config('docs.access_token');

        if (empty($repository)) {
            $this->error('The documentation repository is not set.');
            return;
        }

        if (empty($branch)) {
            $this->error('The documentation branch is not set.');
            return;
        }

        if (is_dir(resource_path('docs'))) {
            $this->info('Pulling latest documentation updates...');

            exec('git -C ' . resource_path('docs') . ' pull');
        } else {
            $this->info('Cloning documentation...');

            $command = "git clone --single-branch --branch {$branch} {$repository} " . resource_path('docs');

            if (!empty($accessToken)) {
                $accessToken = base64_encode("{$accessToken}:x-oauth-basic");
                $command .= " --config 'http.extraheader=AUTHORIZATION: Basic {$accessToken}'";
            }

            exec($command);
        }

        $this->info('Documentation updated!');
    }
}
