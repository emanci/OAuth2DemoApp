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
$app->get('/log', 'App\Controllers\HomeController:log')->setName('home.log');
$app->group(
    '/photo',
    function () use ($app) {
        //echo "<pre>";
        //print_r($app->getContainer());
        $controller = new \App\Controllers\PhotoController($app);

        $app->get('', $controller('index'));


        //$app->get('', 'App\Controllers\PhotoController:index');
        $app->get('/create', 'App\Controllers\PhotoController:create');
        $app->post('', 'App\Controllers\PhotoController:store');
        $app->get('/{id}', 'App\Controllers\PhotoController:show');
        $app->get('/{id}/edit', 'App\Controllers\PhotoController:edit');
        $app->map(['PUT', 'PATCH'], '/{id}', 'App\Controllers\PhotoController:update');
        $app->delete('/{id}', 'App\Controllers\PhotoController:destroy');
    }
);