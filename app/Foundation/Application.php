<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/2.
 */

namespace App\Foundation;

use App\Facades\MailFacade;
use App\Facades\SomeServiceFacade;
use App\Foundation\Twig\JsonStringifyExtension;
use App\Services\MailService;
use DavidePastore\Slim\Config\Config;
use ReflectionClass;
use Slim\App;
use App\Models\User;
use Slim\Views\Twig;
use Pimple\Container;
use Slim\Flash\Messages;
use Slim\Views\TwigExtension;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Facade;
use Illuminate\Database\Capsule\Manager;

class Application extends Container
{
    /**
     * @var null|App
     */
    protected static $app = null;

    /**
     * Service Providers.
     *
     * @var array
     */
    protected static $providers = [];

    /**
     * Application constructor.
     *
     * @param null $config
     */
    public function __construct($config = null)
    {
        parent::__construct();
        session_start();
        $this->initContainer();
        $this->registerDependencies();
        $this->setFacade();
        $this->registerAlias();
    }

    /**
     * Initial application container.
     */
    protected function initContainer()
    {
        self::$app = new App(
            [
                'settings' => [
                    'httpVersion'                       => '1.1',
                    'responseChunkSize'                 => 4096,
                    'outputBuffering'                   => 'append',
                    'determineRouteBeforeAppMiddleware' => false,
                    'displayErrorDetails'               => true,
                    'db'                                => [
                        'driver'    => 'mysql',
                        'host'      => 'localhost',
                        'database'  => 'oauth2_app',
                        'username'  => 'root',
                        'password'  => 'root',
                        'charset'   => 'utf8',
                        'collation' => 'utf8_unicode_ci',
                        'prefix'    => '',
                    ],
                ],
            ]
        );

        $container = self::$app->getContainer();

        $container['config'] = function ($container) {
            return new Config(APP_PATH.'/config');
        };

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
            $view->addExtension(new JsonStringifyExtension());
            $view->addExtension();
            if ($container->has('flash')) {
                $view->getEnvironment()->addGlobal('flash', $container->flash);
            }

            return $view;
        };

        $container['some'] = function ($container) {
            return new User();
        };

        $container['mail'] = function ($container) {
            return new MailService();
        };

        self::$app->add($container->get('config'));
        self::$app->add(new AuthMiddleware($container));
        self::$app->add(new RoleMiddleware($container));
    }

    /**
     * register controller dependencies.
     *
     * @return void
     */
    protected function registerDependencies()
    {
        $container = self::$app->getContainer();
        $controllersConf = require APP_PATH.'/config/controllers.php';
        $controllers = $controllersConf['controllers'];

        foreach ($controllers as $controller) {
            $container[$controller] = function ($container) use ($controller) {
                $reflector = new ReflectionClass($controller);
                $constructor = $reflector->getConstructor();
                $parameters = $constructor->getParameters();
                array_shift($parameters);
                $depsInstances = $this->getDepsInstances($parameters);
                array_unshift($depsInstances, $container);

                return $reflector->newInstanceArgs($depsInstances);
            };
        }
    }

    /**
     * Get all dependency instance.
     *
     * @param array $parameters
     *
     * @return array
     */
    protected function getDepsInstances(array $parameters)
    {
        $depsInstances = [];

        foreach ($parameters as $value) {
            $reflectionClass = $value->getClass();
            $class = $reflectionClass->getName();
            $depsInstances[] = new $class();
        }

        return $depsInstances;
    }

    /**
     * Set Container to facade.
     */
    protected function setFacade()
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication(self::$app->getContainer());
    }

    /**
     * register Facade Alias.
     *
     * @throws Exception
     */
    protected function registerAlias()
    {
        $aliases = array(
            'App\Controllers\FuckName' => SomeServiceFacade::class,
            'App\Controllers\FuckMail' => MailFacade::class,
        );

        AliasLoader::getInstance($aliases)->register();
    }

    /**
     * Resolve the given type from the container.
     *
     * @param $make
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public static function make($make)
    {
        if (is_null($make)) {
            return self::$app->getContainer();
        }

        return self::$app->getContainer()->get($make);
    }

    /**
     * Get Application.
     *
     * @return null|App
     */
    public static function app()
    {
        return self::$app;
    }

    /**
     * Run application.
     */
    public function run()
    {
        $app = self::$app;
        require APP_PATH.'/app/routers.php';
        $app->run();
    }
}
