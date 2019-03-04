<?php
namespace SethPhat\Search3;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider {
    const NAMESPACE = "search3";
    const CONFIG_FILE = [
        'search3' => __DIR__ . '/Config/search3.php',
        'search3_hook' => __DIR__ . '/Config/hook.php',
    ];

    public function register()
    {
        // register configs
        foreach (static::CONFIG_FILE as $namespace => $path) {
            $this->mergeConfigFrom($path, $namespace);
        }
    }

    public function boot() {
        $this->_load();
        $this->_publish();
    }

    private function _load() {
        // load route
        $this->loadRoutesFrom(__DIR__ . "/routes.php");

        // load migration
        $this->loadMigrationsFrom(__DIR__ . "/Migration");

        // load views
        $this->loadViewsFrom(__DIR__ . "/View", static::NAMESPACE);

        // load translation
        $this->loadTranslationsFrom(__DIR__ . "/Language", static::NAMESPACE);
    }

    private function _publish() {
        // publish assets
        $this->publishes([
            __DIR__ . "/../assets" => public_path('vendor/search3')
        ], static::NAMESPACE . '.public'); // search3.public

        // publish config
        $configs = [];
        foreach (static::CONFIG_FILE as $namespace => $path) {
            $configs[$path] = config_path($namespace . ".php");
        }
        $this->publishes($configs, static::NAMESPACE.'.config'); // search3.config

        // publish translation
        $this->publishes([
            __DIR__ . "/Language" => resource_path('lang/vendor/search3')
        ], static::NAMESPACE.'.translation'); // search3.translation
    }
}