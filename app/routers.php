<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/2.
 */

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

        // Receive implicit token
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

        // Refresh token
        $app->get(
            '/client/request_token/refresh_token',
            'App\Controllers\Client\RequestToken:requestTokenWithRefreshToken'
        )->setName('requestToken.request_token_with_refresh_token');

        // Request resource
        $app->get('/client/request_resource', 'App\Controllers\Client\RequestResource:requestResource')->setName(
            'requestResource.request_resource'
        );

        // User Credentials
        $app->get(
            '/client/request_token/user_credentials',
            'App\Controllers\Client\RequestToken:requestTokenWithUserCredentials'
        )->setName('requestToken.request_token_with_usercredentials');
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
