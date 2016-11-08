<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/2.
 */
namespace App\Foundation;

use Slim\App;
use Slim\Views\Twig;
use Pimple\Container;
use Slim\Flash\Messages;
use Slim\Views\TwigExtension;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Illuminate\Database\Capsule\Manager;

class Application extends Container
{
    /**
     * @var null|App
     */
    protected $app = null;

    /**
     * Service Providers.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * Application constructor.
     *
     * @param null $config
     */
    public function __construct($config = null)
    {
        session_start();
        $this->app = new App(
            [
                'settings' => [
                    'httpVersion' => '1.1',
                    'responseChunkSize' => 4096,
                    'outputBuffering' => 'append',
                    'determineRouteBeforeAppMiddleware' => false,
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

        // Service factory for the ORM
        $capsule = new Manager();
        $capsule->addConnection($container['settings']['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $container['db'] = function ($container) use ($capsule) {
            return $capsule;
        };

        $container['flash'] = function ($container) {
            return new Messages();
        };

        $container['view'] = function ($container) {
            $cache = false;
            $view = new Twig(
                APP_PATH.'/resources/views/', [
                    'cache' => $cache,
                ]
            );
            $view->addExtension(
                new TwigExtension(
                    $container->router,
                    $container->request->getUri()
                )
            );
            if ($container->has('flash')) {
                $view->getEnvironment()->addGlobal('flash', $container->flash);
            }

            return $view;
        };

        $this->app->add(new AuthMiddleware($container));
        $this->app->add(new RoleMiddleware($container));
    }

    /**
     * Run application.
     */
    public function run()
    {
        $app = $this->app;
        require APP_PATH.'/app/routers.php';
        $app->run();
    }
}
