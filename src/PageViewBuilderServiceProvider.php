<?php

namespace JPeters\PageViewBuilder;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class PageViewBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../views', 'page-view-builder');
    }

    public function boot()
    {
        $this->bindInstances();
    }

    public function register()
    {
        $this->loadConfiguration();

        if ($this->app->runningInConsole()) {
            $this->registerPublishCommands();
        }
    }

    protected function registerPublishCommands(): void
    {
        $this->publishes([
            __DIR__ . '/../config/laravel-page-view.php' => config_path('laravel-page-view.php'),
        ], 'laravel-page-view-config');

        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/page-view-builder'),
        ], 'laravel-page-view-template');
    }

    protected function bindInstances(): void
    {
        $instance = new Page($this->app->make(Request::class), $this->app->make(ResponseFactory::class));

        $this->app->instance(AbstractPage::class, $instance);
        $this->app->instance(PageViewBuilder::class, $instance);
    }

    protected function loadConfiguration(): void
    {
        if (!$this->app->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__ . '/../config/laravel-page-view.php', 'laravel-page-view');
        }
    }
}
