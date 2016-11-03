<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/2.
 */
define("APP_PATH", realpath(dirname(__FILE__).'/../'));
require __DIR__.'/../bootstrap/autoload.php';
(new \App\Foundation\Application())->run();