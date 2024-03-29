<?php

namespace Krzychu12350\MetasploitApi\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallMetasploitApiPackage extends Command
{
    protected $signature = 'metasploit-api:install';

    protected $description = 'Install the Metasploit API Package';

    public function handle()
    {
        $this->info('Installing Metasploit API Package...');

        $this->info('Publishing configuration...');

        if (!$this->configExists('route-attributes.php')) {
            $this->publishConfiguration();
            $this->info('Published configuration');
        } else {
            if ($this->shouldOverwriteConfig()) {
                $this->info('Overwriting configuration file...');
                $this->publishConfiguration($force = true);
            } else {
                $this->info('Existing configuration was not overwritten');
            }
        }

        $this->info('Installed Metasploit API Package');
    }

    private function configExists($fileName)
    {
        return File::exists(config_path($fileName));
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "Krzychu12350\MetasploitApi\MetasploitApiServiceProvider",
            '--tag' => "Config"
        ];

        $params2 = [
            '--provider' => "Arcanedev\LaravelSettings\SettingsServiceProvider",
            '--tag' => "Config"
        ];

        if ($forcePublish === true) {
            $params['--force'] = true;
        }

        $this->call('vendor:publish', $params);
        $this->call('vendor:publish', $params2);
    }

    private function shouldOverwriteConfig()
    {
        return $this->confirm(
            'Config file already exists. Do you want to overwrite it?',
            false
        );
    }
}
