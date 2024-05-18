<?php

namespace Ardi7923\Laravelcmsapi;

use Illuminate\Support\ServiceProvider;

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
//
//        $this->publishes([
//            __DIR__.'/assets/js/share' => public_path('js'),
//        ]);

//        if ($this->app->runningInConsole()) {
//            $this->commands([
//                CrudAjax::class,
//                CrudAjaxBladeCompiler::class,
//                CrudAjaxSetCommand::class
//            ]);
//        }
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
