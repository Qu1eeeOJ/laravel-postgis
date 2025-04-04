<?php

namespace MStaack\LaravelPostgis;

use Illuminate\Database\DatabaseServiceProvider as IlluminateDatabaseServiceProvider;
use Illuminate\Database\DatabaseManager;
use MStaack\LaravelPostgis\Connectors\ConnectionFactory;

class DatabaseServiceProvider extends IlluminateDatabaseServiceProvider
{
    public function boot()
    {
        // Load the config
        $config_path = __DIR__ . '/../config/postgis.php';
        $this->publishes([$config_path => config_path('postgis.php')], 'postgis');

        if (!class_exists('EnablePostgis')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/enable_postgis.php.stub' => database_path('migrations/'.date('Y_m_d_His', time()).'_enable_postgis.php'),
            ], 'migrations');
        }

        $this->mergeConfigFrom($config_path, 'postgis');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // The connection factory is used to create the actual connection instances on
        // the database. We will inject the factory into the manager so that it may
        // make the connections while they are actually needed and not of before.
        $this->app->singleton('db.factory', function ($app) {
            return new ConnectionFactory($app);
        });

        // The database manager is used to resolve various connections, since multiple
        // connections might be managed. It also implements the connection resolver
        // interface which may be used by other components requiring connections.
        $this->app->singleton('db', function ($app) {
            return new DatabaseManager($app, $app['db.factory']);
        });
    }
}
