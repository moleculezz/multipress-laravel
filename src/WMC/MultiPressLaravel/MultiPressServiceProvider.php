<?php namespace WMC\MultiPressLaravel;

use Illuminate\Support\ServiceProvider;
use WMC\MultiPress\Client;
use WMC\MultiPress\Service;

class MultiPressServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('wmc/multipress');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['multipress'] = $this->app->share(function ($app) {
            $conn = new Client($app['config']->get('multipress::wsdl'), $app['config']->get('multipress::options'));

            return new Service($conn);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
