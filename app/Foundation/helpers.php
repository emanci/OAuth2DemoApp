<?php
/*
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/14.
 */

use App\Foundation\Application;

if (!function_exists('app')) {
    /**
     * Get the available container instance..
     *
     * @param null  $service
     * @param array $parameters
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    function app($service = null, $parameters = [])
    {
        return Application::make($service);
    }
}
if (!function_exists('config')) {
    /**
     * Get / set the specified configuration value.
     *
     * If an array is passed as the key, we will assume you want to set an array of values.
     *
     * @param null $key
     * @param null $default
     *
     * @return mixed|void|config
     */
    function config($key = null, $default = null)
    {
        return $default;
    }
}

if (!function_exists('controller')) {
    /**
     * @param $controllerName
     *
     * @return null
     */
    function controller($controllerName)
    {
        if (class_exists($controllerName)) {
            return new $controllerName(Application::app()->getContainer());
        }

        return null;
    }
}
