<?php namespace Bentlov\Generators;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerServiceGeneratorCommand();

        $this->commands(
            'generate.service'
        );
	}

    protected function registerServiceGeneratorCommand()
    {
        $this->app['generate.service'] = $this->app->share(function($app)
        {
            return new Commands\ServiceGeneratorCommand;
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
