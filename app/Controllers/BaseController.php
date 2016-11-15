<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/3.
 */
namespace App\Controllers;

use Interop\Container\ContainerInterface;
use Slim\Http\Response;

abstract class BaseController
{
    /**
     * @var ContainerInterface
     */
    protected $app;

    /**
     * BaseController constructor.
     *
     * @param ContainerInterface $app
     */
    public function __construct(ContainerInterface $app)
    {
        $this->app = $app;
    }

    /**
     * @param $actionName
     *
     * @return \Closure
     */
    public function __invoke($actionName)
    {
        $app = $this->app;
        $controller = $this;
        $callable = function ($request, $response, $args) use ($app, $controller, $actionName) {
            return call_user_func_array(array($controller, $actionName), [$request, $response, $args]);
        };

        return $callable;
    }

    /**
     * Get app container.
     *
     * @return ContainerInterface
     */
    public function getApp()
    {
        return $this->app;
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
