<?php

namespace Ardi7923\Laravelcmsapi;

use Illuminate\Support\ServiceProvider;
use Ardi7923\Laravelcmsapi\Console\Commands\CrudApi;

class LaravelcmsapiServiceProvider extends ServiceProvider
{

    /**
     * Boot the instance, add macros for datatable engines.
     *
     * @return void
     */
    public function boot()
    {
       $this->publishes([
           __DIR__.'/Resources/swagger' => public_path('swagger'),
       ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CrudApi::class,
            ]);
        }
    }
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
