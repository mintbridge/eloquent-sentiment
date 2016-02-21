<?php

namespace Mintbridge\EloquentSentiment;

use Illuminate\Support\ServiceProvider;
use Mintbridge\EloquentSentiment\SentimentManager;

class SentimentServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the config and migrations.
     */
    public function boot()
    {
        // Publish a config file
        $this->publishes([
            __DIR__.'/config/eloquent-sentiment.php' => config_path('eloquent-sentiment.php'),
        ], 'config');

        // Publish migrations
        $this->publishes([
            __DIR__.'/migrations/create_sentiments_table.php.stub' => base_path(
                '/database/migrations/'.date('Y_m_d_His', time()).'_create_sentiments_table.php'
            ),
        ], 'migrations');
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('sentiments', function($app) {
            $sentiments = $app['config']->get('eloquent-sentiment.sentiments');

            $manager = new SentimentManager($sentiments);

            return $manager;
        });

        $this->app->alias('sentiments', SentimentManager::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sentiment'];
    }
}
