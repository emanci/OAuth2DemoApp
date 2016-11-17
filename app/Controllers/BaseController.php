<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/3.
 */
namespace App\Controllers;

use Slim\Http\Response;
use Interop\Container\ContainerInterface;

abstract class BaseController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * BaseController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * This method allows use to return a callable that calls the action for the route.
     *
     * @param $actionName
     *
     * @return \Closure
     */
    public function __invoke($actionName)
    {
        $container = $this->container;
        $controller = $this;
        $callable = function ($request, $response, $args) use ($container, $controller, $actionName) {
            return call_user_func_array(array($controller, $actionName), [$request, $response, $args]);
        };

        return $callable;
    }

    /**
     * Render the template.
     *
     * @param $response
     * @param $template
     * @param $data
     *
     * @return mixed
     */
    public function render(Response $response, $template, array $data = [])
    {
        return $this->app->view->render($response, $template, $data);
    }
}
