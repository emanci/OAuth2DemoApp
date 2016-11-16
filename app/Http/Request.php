<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/16.
 */
namespace App\Http;

use Slim\Http\Request as SlimRequest;

class Request extends SlimRequest
{
    /**
     * Get a cookie, or a default value if not set.
     *
     * @param      $name
     * @param null $default
     *
     * @return null
     */
    public function getCookie($name, $default = null)
    {
        $cookies = $this->getCookieParams();

        return array_key_exists($name, $cookies) ? $cookies[$name] : $default;
    }
}
