<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/16.
 */

namespace app\Http;

use Slim\Http\Response as SlimResponse;

class Response extends SlimResponse
{
    /**
     * Name of last controller called.
     *
     * @var
     */
    protected $controllerClass;

    /**
     * Name of last controller called.
     *
     * @var
     */
    protected $controllerName;

    /**
     * Name of last action called.
     *
     * @var
     */
    protected $actionName;

    /**
     * Get the last controller called.
     *
     * @return mixed
     */
    public function getControllerClass()
    {
        return $this->controllerClass;
    }

    /**
     * Get the last controller called.
     *
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * Get the last controller called.
     *
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * Set the last controller called.
     *
     * @param $controllerClass
     *
     * @return mixed
     */
    public function setControllerClass($controllerClass)
    {
        return $this->controllerClass = $controllerClass;
    }

    /**
     * Set the last controller called.
     *
     * @param $controllerName
     *
     * @return mixed
     */
    public function setControllerName($controllerName)
    {
        return $this->controllerName = $controllerName;
    }

    /**
     * Set the last controller called.
     *
     * @param $actionName
     */
    public function setActionName($actionName)
    {
        $this->actionName = $actionName;
    }
}
