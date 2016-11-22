<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/3.
 */

namespace App\Controllers;

use App\Traits\TestingTrait;
use Slim\Http\Response;
use Interop\Container\ContainerInterface;

abstract class BaseController
{
    use TestingTrait;

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
            $controller->process($response, $controller, $actionName);

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
        return $this->container->view->render($response, $template, $data);
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
