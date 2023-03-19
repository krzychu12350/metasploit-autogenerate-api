<?php

namespace Krzychu12350\MetasploitApi;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class PluginInstaller implements PluginInterface, EventSubscriberInterface
{
    protected $composer;
    protected $io;

    public static function getSubscribedEvents()
    {
        return [
            'post-package-install' => 'onPostPackageInstallOrUpdate',
            'post-package-update' => 'onPostPackageInstallOrUpdate'
        ];
    }

    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    public function deactivate(Composer $composer, IOInterface $io)
    {

    }

    public function uninstall(Composer $composer, IOInterface $io)
    {
    }

    public function onPostPackageInstallOrUpdate(PackageEvent $event)
    {
        $metasploitApiGenerator = new MetasploitApiGenerator();
        $metasploitApiGenerator::generateApi();
    }
}
