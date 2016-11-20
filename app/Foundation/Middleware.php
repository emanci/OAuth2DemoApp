<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/7.
 */

namespace App\Foundation;

abstract class Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}
