<?php

namespace JPeters\PageViewBuilder\Tests;

use Illuminate\Foundation\Application;
use JPeters\PageViewBuilder\Providers\PageViewBuilderServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [PageViewBuilderServiceProvider::class];
    }

    protected function resolveApplicationBootstrappers($app)
    {
        $app['config']->set(['view.paths' => [__DIR__.'/views']]);

        parent::resolveApplicationBootstrappers($app);
    }
}
