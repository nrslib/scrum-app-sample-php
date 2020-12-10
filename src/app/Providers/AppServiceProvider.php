<?php

namespace App\Providers;

use App\Providers\ServiceProviders\LocalServiceProvider;
use App\Providers\ServiceProviders\ProductionServiceProvider;
use App\Providers\ServiceProviders\Provider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $provider = $this->provider();
        $provider->register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $provider = $this->provider();
        $provider->boot();
    }

    private function provider(): Provider
    {
        $env = config("app.env");
        switch ($env) {
            case "local":
                return new LocalServiceProvider($this->app);
            case "production":
                return new ProductionServiceProvider($this->app);
            default:
                throw new \OutOfBoundsException();
        }
    }
}
