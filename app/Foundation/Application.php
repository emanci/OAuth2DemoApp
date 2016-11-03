<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/2.
 */
namespace App\Foundation;

use App\Controllers\HomeController;
use Pimple\Container;

class Application extends Container
{
    /**
     * Service Providers.
     *
     * @var array
     */
    protected $providers = [];

    protected $app = null;

    public function __construct($config = null)
    {
        $this->app = new \Slim\App(
            [
                'settings' => [
                    'displayErrorDetails' => true,
                    'db' => [
                        'driver' => 'mysql',
                        'host' => 'localhost',
                        'database' => 'oauth2_app',
                        'username' => 'root',
                        'password' => 'root',
                        'charset' => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix' => '',
                    ],
                ],
            ]
        );
        $container = $this->app->getContainer();

        /*$container['HomeController'] = function ($container) {
            return new HomeController($container);
        };*/
    }

    public function run()
    {
        $app = $this->app;
        require APP_PATH.'/app/routers.php';
        $app->run();
    }
}
