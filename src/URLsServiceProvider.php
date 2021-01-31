<?php

namespace Pharous\Laravel\Eloquent\URL;

use Illuminate\Support\ServiceProvider;

class URLsServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishes
        $this->publishes([
            __DIR__ . '/database/migrations/urls.stub'         => database_path(sprintf('migrations/%s_create_urls_table.php',          date('Y_m_d_His', time()))),
        ], ['pharous', 'laravel-eloquent-urls']);

        // Loads
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
    }
}
