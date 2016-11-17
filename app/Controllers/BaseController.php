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
     * @var
     */
    protected $request;

    /**
     * @var
     */
    protected $response;

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
            $controller->setRequest($request);
            $controller->setResponse($response);

            // store the name of the controller and action so we can assert during tests.
            $controllerName = get_class($controller);
            $controllerName = strtolower($controllerName);
            $controllerNameParts = explode('\\', $controllerName);
            $controllerName = array_pop($controllerNameParts);
            preg_match('/(.*)controller$/', $controllerName, $result);
            $controllerName = $result[1];

            // these values will be useful when testing, but not included with the
            // Slim\Http\Response. Instead use SlimMvc\Http\Response
            if (method_exists($response, 'setControllerName')) {
                $response->setControllerName($controllerName);
            }
            if (method_exists($response, 'setControllerClass')) {
                $response->setControllerClass(get_class($controller));
            }
            if (method_exists($response, 'setActionName')) {
                $response->setActionName($actionName);
            }

            return call_user_func_array(array($controller, $actionName), [$request, $response, $args]);
        };

        return $callable;
    }

    /**
     * Set request.
     *
     * @param $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * Set response.
     *
     * @param $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
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

    /**
     * Redirect.
     *
     * Note: This method is not part of the PSR-7 standard.
     *
     * This method prepares the response object to return an HTTP Redirect
     * response to the client.
     *
     * @param     $url
     * @param int $status
     *
     * @return mixed
     */
    protected function redirect($url, $status = 302)
    {
        return $this->response->withRedirect($url, $status);
    }
}
