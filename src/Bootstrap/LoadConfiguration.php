<?php

namespace Radcliffe\LaravelSettingsInjector\Bootstrap;

use Illuminate\Foundation\Bootstrap\LoadConfiguration as LaravelLoadConfiguration;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Config\Repository as RepositoryContract;
use Symfony\Component\Finder\Finder;

/**
 * Replaces Laravel's configuration loader.
 *
 * This allows to inject a settings file so that parameters can be used from
 * outside of the Laravel application root.
 */
class LoadConfiguration extends LaravelLoadConfiguration
{

    /**
     * {@inheritdoc}
     */
    protected function loadConfigurationFiles(Application $app, RepositoryContract $repository)
    {
        // @todo Allow configurable settings directory, but not in config. :-)
        $settings_path = $app->basePath() . DIRECTORY_SEPARATOR . 'settings';

        // @see \Illuminate\Foundation\Bootstrap\LoadConfiguration::loadConfigurationFiles

        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach (Finder::create()->files()->name('settings.php')->in($settings_path) as $file) {
            require_once $file->getRealPath();
        }

        foreach ($this->getConfigurationFiles($app) as $key => $path) {
            $repository->set($key, require $path);
        }
    }
}
