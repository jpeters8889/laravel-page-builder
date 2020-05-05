<?php

namespace JPeters\PageViewBuilder;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class PageViewBuilderServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../views', 'page-view-builder');
    }

    public function register()
    {
        if (!$this->app->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__ . '/../../config/laravel-page-view.php', 'laravel-page-view');
        }

        $instance = new Page($this->app->make(Request::class), $this->app->make(ResponseFactory::class));

        $this->app->instance(AbstractPage::class, $instance);
        $this->app->instance(AbstractPage::class, $instance);

        $this->publishes([__DIR__ . '/../../public' => public_path('vendor/page-view-builder')]);
    }
}
