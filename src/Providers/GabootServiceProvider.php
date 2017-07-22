<?php

namespace App\Components\Gaboot\Providers;

use Illuminate\Support\ServiceProvider;

class GabootServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\App\Components\Signature\Providers\SignatureServiceProvider::class);
        $this->app->register(\App\Components\Siegnor\Providers\SiegnorServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../../Config/config.php' => config_path('gaboot.php'),
        ], 'config-gaboot');
        $this->mergeConfigFrom(
            __DIR__ . '/../../Config/config.php', 'gaboot'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/components/gaboot');

        $sourcePath = __DIR__ . '/../../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/components/gaboot';
        }, \Config::get('view.paths')), [$sourcePath]), 'gaboot');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/components/gaboot');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'gaboot');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../../Resources/lang', 'gaboot');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
