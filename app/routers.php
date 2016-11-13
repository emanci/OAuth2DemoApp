<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/2.
 */

$app->get('/', 'App\Controllers\HomeController:index')->setName('home');
$app->get('/user', 'App\Controllers\HomeController:user')->setName('home.user');
$app->get(
    '/test/{name}',
    function ($request, $response, $args) {
        return $this->view->render(
            $response,
            '/user/profile.twig',
            [
                'nickname' => $args['name'],
            ]
        );
    }
);
$app->get('/some', 'App\Controllers\HomeController:some')->setName('home.some');