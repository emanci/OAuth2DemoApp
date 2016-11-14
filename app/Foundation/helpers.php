<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/14.
 */
if (!function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param null  $service
     * @param array $parameters
     */
    function app($service = null, $parameters = [])
    {

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