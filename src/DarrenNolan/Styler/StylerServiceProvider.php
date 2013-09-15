<?php namespace DarrenNolan\Styler;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\AliasLoader;

class StylerServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    protected $compiler;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('darren-nolan/styler');

        AliasLoader::getInstance()->alias('Styler', 'DarrenNolan\Styler\StylerFacade');

        $this->compiler = $this->registerCompiler( Config::get('styler::compiler') );

        include __DIR__ . '/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['styler'] = $this->app->share(function($app)
        {
            return new Styler($this->compiler);
        });
	}

    protected function registerCompiler ($compiler_name)
    {
        $configuration = Config::get('styler::compilers.'.$compiler_name);

        // DarrenNolan\Compilers\(Auto|Scss|Less) Compilers
        $class_name = __NAMESPACE__ . '\\Compilers\\' . $compiler_name;

        if (class_exists($class_name)) {
            return new $class_name($configuration);
        }

        if (class_exists($compiler_name)) {
            return new $class_name($configuration);
        }
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
