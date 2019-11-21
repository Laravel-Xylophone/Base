<?php

namespace Xylophone\Base;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Route;

class BaseServiceProvider extends ServiceProvider
{
    const VERSION = '1.0.0';

    protected $commands = [
        \Xylophone\Base\app\Console\Commands\Install::class,
        \Xylophone\Base\app\Console\Commands\AddSidebarContent::class,
        \Xylophone\Base\app\Console\Commands\AddCustomRouteContent::class,
        \Xylophone\Base\app\Console\Commands\Version::class,
        \Xylophone\Base\app\Console\Commands\CreateUser::class,
        \Xylophone\Base\app\Console\Commands\PublishXylophoneUserModel::class,
        \Xylophone\Base\app\Console\Commands\PublishXylophoneMiddleware::class,
    ];

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
     *
     * @var string
     */
    public $routeFilePath = '/routes/xylophone/base.php';

    /**
     * Where custom routes can be written, and will be registered by Xylophone.
     *
     * @var string
     */
    public $customRoutesFilePath = '/routes/xylophone/custom.php';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(\Illuminate\Routing\Router $router)
    {
        $_SERVER['XYLOPHONE_BASE_VERSION'] = $this::VERSION;
        $customViewsFolder = resource_path('views/vendor/xylophone/base');

        // LOAD THE VIEWS
        // - first the published views (in case they have any changes)
        if (file_exists(resource_path('views/vendor/xylophone/base'))) {
            $this->loadViewsFrom($customViewsFolder, 'xylophone');
        }
        // - then the stock views that come with the package, in case a published view might be missing
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'xylophone');

        $this->loadTranslationsFrom(realpath(__DIR__.'/resources/lang'), 'xylophone');

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/xylophone/base.php', 'xylophone.base'
        );

        // add the root disk to filesystem configuration
        app()->config['filesystems.disks.'.config('xylophone.base.root_disk_name')] = [
            'driver' => 'local',
            'root'   => base_path(),
        ];

        $this->addCustomAuthConfigurationValues();
        $this->registerMiddlewareGroup($this->app->router);
        $this->setupRoutes($this->app->router);
        $this->setupCustomRoutes($this->app->router);
        $this->publishFiles();
        $this->checkLicenseCodeExists();
    }

    /**
     * Load the Xylophone helper methods, for convenience.
     */
    public function loadHelpers()
    {
        require_once __DIR__.'/helpers.php';
    }

    /**
     * Xylophone login differs from the standard Laravel login.
     * As such, Xylophone uses its own authentication provider, password broker and guard.
     *
     * This method adds those configuration values on top of whatever is in config/auth.php. Developers can overwrite the xylophone provider, password broker or guard by adding a provider/broker/guard with the "xylophone" name inside their config/auth.php file. Or they can use another provider/broker/guard entirely, by changing the corresponding value inside config/xylophone/base.php
     */
    public function addCustomAuthConfigurationValues()
    {
        // add the xylophone_users authentication provider to the configuration
        app()->config['auth.providers'] = app()->config['auth.providers'] +
        [
            'xylophone' => [
                'driver'  => 'eloquent',
                'model'   => config('xylophone.base.user_model_fqn'),
            ],
        ];

        // add the xylophone_users password broker to the configuration
        app()->config['auth.passwords'] = app()->config['auth.passwords'] +
        [
            'xylophone' => [
                'provider'  => 'xylophone',
                'table'     => 'password_resets',
                'expire'    => 60,
            ],
        ];

        // add the xylophone_users guard to the configuration
        app()->config['auth.guards'] = app()->config['auth.guards'] +
        [
            'xylophone' => [
                'driver'   => 'session',
                'provider' => 'xylophone',
            ],
        ];
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // by default, use the routes file provided in vendor
        $routeFilePathInUse = __DIR__.$this->routeFilePath;

        // but if there's a file with the same name in routes/xylophone, use that one
        if (file_exists(base_path().$this->routeFilePath)) {
            $routeFilePathInUse = base_path().$this->routeFilePath;
        }

        $this->loadRoutesFrom($routeFilePathInUse);
    }

    /**
     * Load custom routes file.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupCustomRoutes(Router $router)
    {
        // if the custom routes file is published, register its routes
        if (file_exists(base_path().$this->customRoutesFilePath)) {
            $this->loadRoutesFrom(base_path().$this->customRoutesFilePath);
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        // register the current package
        $this->app->bind('base', function ($app) {
            return new Base($app);
        });

        // register the helper functions
        $this->loadHelpers();

        // register the services that are only used for development
        if ($this->app->environment() == 'local') {
            if (class_exists('Laracasts\Generators\GeneratorsServiceProvider')) {
                $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
            }
            if (class_exists('Xylophone\Generators\GeneratorsServiceProvider')) {
                $this->app->register('Xylophone\Generators\GeneratorsServiceProvider');
            }
        }

        // register the artisan commands
        $this->commands($this->commands);
    }

    public function registerMiddlewareGroup(Router $router)
    {
        $middleware_key = config('xylophone.base.middleware_key');
        $middleware_class = config('xylophone.base.middleware_class');

        if (!is_array($middleware_class)) {
            $router->pushMiddlewareToGroup($middleware_key, $middleware_class);

            return;
        }

        foreach ($middleware_class as $middleware_class) {
            $router->pushMiddlewareToGroup($middleware_key, $middleware_class);
        }
    }

    public function publishFiles()
    {
        $error_views = [__DIR__.'/resources/error_views' => resource_path('views/errors')];
        $xylophone_base_views = [__DIR__.'/resources/views' => resource_path('views/vendor/xylophone/base')];
        $xylophone_public_assets = [__DIR__.'/public' => public_path('vendor/xylophone')];
        $xylophone_lang_files = [__DIR__.'/resources/lang' => resource_path('lang/vendor/xylophone')];
        $xylophone_config_files = [__DIR__.'/config' => config_path()];

        // sidebar_content view, which is the only view most people need to overwrite
        $xylophone_menu_contents_view = [
            __DIR__.'/resources/views/inc/sidebar_content.blade.php'      => resource_path('views/vendor/xylophone/base/inc/sidebar_content.blade.php'),
            __DIR__.'/resources/views/inc/topbar_left_content.blade.php'  => resource_path('views/vendor/xylophone/base/inc/topbar_left_content.blade.php'),
            __DIR__.'/resources/views/inc/topbar_right_content.blade.php' => resource_path('views/vendor/xylophone/base/inc/topbar_right_content.blade.php'),
        ];
        $xylophone_custom_routes_file = [__DIR__.$this->customRoutesFilePath => base_path($this->customRoutesFilePath)];

        // calculate the path from current directory to get the vendor path
        $vendorPath = dirname(__DIR__, 3);
        $adminlte_assets = [$vendorPath.'/almasaeed2010/adminlte' => public_path('vendor/adminlte')];
        $gravatar_assets = [$vendorPath.'/creativeorange/gravatar/config' => config_path()];

        // establish the minimum amount of files that need to be published, for Xylophone to work; there are the files that will be published by the install command
        $minimum = array_merge(
            $error_views,
            // $xylophone_base_views,
            $xylophone_public_assets,
            // $xylophone_lang_files,
            $xylophone_config_files,
            $xylophone_menu_contents_view,
            $xylophone_custom_routes_file,
            $adminlte_assets,
            $gravatar_assets
        );

        // register all possible publish commands and assign tags to each
        $this->publishes($xylophone_config_files, 'config');
        $this->publishes($xylophone_lang_files, 'lang');
        $this->publishes($xylophone_base_views, 'views');
        $this->publishes($xylophone_menu_contents_view, 'menu_contents');
        $this->publishes($error_views, 'errors');
        $this->publishes($xylophone_public_assets, 'public');
        $this->publishes($xylophone_custom_routes_file, 'custom_routes');
        $this->publishes($adminlte_assets, 'adminlte');
        $this->publishes($gravatar_assets, 'gravatar');
        $this->publishes($minimum, 'minimum');
    }

    /**
     * Check to to see if a license code exists.
     * If it does not, throw a notification bubble.
     *
     * @return void
     */
    private function checkLicenseCodeExists()
    {
        if ($this->app->environment() != 'local' && !config('xylophone.base.license_code')) {
            \Alert::add('warning', "<strong>You're using unlicensed software.</strong> Please ask your web developer to <a target='_blank' href='http://xylophoneforlaravel.com'>purchase a license code</a> to hide this message.");
        }
    }
}
