<?php

namespace Radcliffe\Tests\LaravelSettingsInjector\Bootstrap;

use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use PHPUnit\Framework\TestCase;

/**
 * Test that configuration can use arbitrary variable.
 *
 * @coversDefaultClass \Radcliffe\LaravelSettingsInjector\Bootstrap\LoadConfiguration
 * @group laravel-settings-injector
 */
class LoadConfigurationTest extends TestCase
{

    /**
     * @var Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var Illuminate\Filesystem\Filesystem
     */

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $base_path = __DIR__ . DIRECTORY_SEPARATOR . '../../fixtures';

        $this->app = new Application();
        $this->app['env'] = 'production';
        $this->app->setBasePath($base_path);
        $this->app->instance('config', new Repository());

        $this->app['config']->set('app', [
            'timezone' => 'UTC',
            'url' => 'http://example.com',
        ]);
    }

    public function testSettings()
    {
        $this->app->bootstrapWith([
            'Radcliffe\LaravelSettingsInjector\Bootstrap\LoadConfiguration',
        ]);

        $this->assertEquals('test_value', $this->app['config']->get('test.name'));
        $this->assertEquals('Not Laravel', $this->app['config']->get('app.name') );
    }
}
