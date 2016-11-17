<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/17.
 */
namespace App\Traits;

trait TestingTrait
{
    /**
     * Store the name of the controller and action so we can assert during tests.
     *
     * @param $response
     * @param $controller
     * @param $actionName
     *
     * @return void
     */
    public function process($response, $controller, $actionName)
    {
        $controllerName = $this->parseControllerName($controller);
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
    }

    /**
     * Returns the name of the controller obtained.
     *
     * @param $controller
     *
     * @return mixed
     */
    protected function parseControllerName($controller)
    {
        $controllerName = get_class($controller);
        $controllerName = strtolower($controllerName);
        $controllerNameParts = explode('\\', $controllerName);
        $controllerName = array_pop($controllerNameParts);
        preg_match('/(.*)controller$/', $controllerName, $result);

        return $result[1];
    }
}