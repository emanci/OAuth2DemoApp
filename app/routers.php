<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/2.
 */
$app->get('/', 'App\Controllers\HomeController:index')->setName('home');
/*$app->get(
    '/',
    function () {
        echo "Welcome Boy";
        die();
    }
);*/
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
$app->get('/mail', 'App\Controllers\HomeController:mail')->setName('home.mail');
$app->get('/log', 'App\Controllers\HomeController:log')->setName('home.log');
$app->group(
    '/photo',
    function () use ($app) {
        $controller = new \App\Controllers\PhotoController($app->getContainer());

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

$app->get('/user/profile', 'App\Controllers\UserController:profile')->setName('user.profile');

/**
 * OAuth2 demo application.
 */
$app->group(
    '/oauth2',
    function () use ($app) {
        // client
        // Homepage
        $app->get('/', 'App\Controllers\Client\WelcomeController:index')->setName('welcome.index');
        // Receive authorization code
        $app->get('/client/receive_authcode', 'App\Controllers\Client\AuthorizationCodeController:receive')->setName(
            'authorizationCode.receive'
        );
        $app->get('/client/receive_implicit_token', 'App\Controllers\Client\ImplicitTokenController:receive')->setName(
            'implicitToken.receive'
        );
        // server
        // Validate authorize request
        $app->get('/lockdin/authorize', 'App\Controllers\Server\AuthorizeController:authorize')->setName(
            'authorize.authorize'
        );
        // Authorize request
        $app->post('/lockdin/authorize', 'App\Controllers\Server\AuthorizeController:authorizeFormSubmit')->setName(
            'authorize.authorize_post'
        );
        // Retrieve access token
        $app->get(
            '/client/request_token/authorization_code',
            'App\Controllers\Client\RequestToken:requestTokenWithAuthCode'
        )->setName('requestToken.request_token_with_authcode');
        // Request resource
        $app->get('/client/request_resource', 'App\Controllers\Client\RequestResource:requestResource')->setName(
            'requestResource.request_resource'
        );
    }
);
$app->group(
    '/token',
    function () use ($app) {
        $app->post('/grant', 'App\Controllers\Server\TokenController:token')->setName('token.grant');
    }
);
$app->group(
    '/resource',
    function () use ($app) {
            $app->get('/access', 'App\Controllers\Server\ResourceController:resource')->setName('resource.access');
    }
);