<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/2.
 */

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');