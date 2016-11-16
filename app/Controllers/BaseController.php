<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/3.
 */
namespace App\Controllers;

use Slim\App;
use Slim\Http\Response;

abstract class BaseController
{
    /**
     * @var App
     */
    protected $app;

    /**
     * BaseController constructor.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
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
        $app = $this->app;
        $controller = $this;
        $callable = function ($request, $response, $args) use ($app, $controller, $actionName) {
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
