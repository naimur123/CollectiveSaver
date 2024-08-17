<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {

        view()->composer('*', function ($view) {
            $systemData = Cache::remember('system_data', 1440, function () {
                $url = 'https://collectivesaverapi.naimur.com.bd/api/v1/system';
                $response = send_request('get', $url);
                return $response->data;
            });

            $view->with('system', $systemData);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
