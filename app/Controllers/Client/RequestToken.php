<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/12/4.
 */

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use GuzzleHttp\Client;
use GuzzleHttp\json_decode;
use Slim\Http\Request;
use Slim\Http\Response;
use InvalidArgumentException;

class RequestToken extends BaseController
{
    /**
     * Request token with authCode.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return mixed
     */
    public function requestTokenWithAuthCode(Request $request, Response $response, $args)
    {
        $code = $request->getParam('code');
        $showRefreshToken = $request->getParam('show_refresh_token');

        $redirectUriParams = array_filter(['show_refresh_token' => $showRefreshToken]);
        $receiveAuthorizationCodeRoute = $this->container->get('router')->pathFor('authorizationCode.receive');
        $authorizeRedirect = $redirectUriParams
            ? $receiveAuthorizationCodeRoute.'?'.http_build_query($redirectUriParams)
            : $receiveAuthorizationCodeRoute;

        $clientId = $showRefreshToken ? 'demoapp2' : config('demo_app.client_id');
        $clientSecret = $showRefreshToken ? 'demopass2' : config('demo_app.client_secret');

        // exchange authorization code for access token
        $data = [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri'  => 'http://local.oauth2.com'.$authorizeRedirect,
        ];

        // determine the token endpoint to call based on our config
        $endpoint = config('demo_app.token_route');
        if (0 !== strpos($endpoint, 'http')) {
            throw new InvalidArgumentException('Invalid URI: http|https scheme required');
        }

        $http = new Client(config('demo_app.http_options'));
        
        $tokenResponse = $http->request('POST', $endpoint, ['form_params' => $data]);
        $json = json_decode($tokenResponse->getBody()->getContents(), true);

        if (isset($json['access_token'])) {
            $data = ['response' => $json];
            $router = $this->container->router;

            if ($showRefreshToken) {
                $requestRefreshTokenRoute = $router->pathFor('requestToken.request_token_with_refresh_token');
                $data['request_refresh_token_url'] = $requestRefreshTokenRoute.'?refresh_token='.$json['refresh_token'];

                return $this->render($response, 'client/token/show_refresh_token.twig', $data);
            }

            $requestResourceRoute = $router->pathFor('requestResource.request_resource');
            $data['request_resource_url'] = $requestResourceRoute.'?token='.$json['access_token'];

            return $this->render($response, 'client/token/show_access_token.twig', $data);
        }

        $data = ['response' => $json ?: $tokenResponse];

        return $this->render($response, 'client/token/failed_token_request.twig', $data);
    }

    /**
     * Request token with refresh token.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return mixed
     */
    public function requestTokenWithRefreshToken(Request $request, Response $response, $args)
    {
        $refreshToken = $request->getParam('refresh_token');

        $query = array(
            'grant_type'    => 'refresh_token',
            'client_id'     => 'demoapp2',
            'client_secret' => 'demopass2',
            'refresh_token' => $refreshToken,
        );

        $grantRoute = config('demo_app.token_route');

        if (0 !== strpos($grantRoute, 'http')) {
            throw new InvalidArgumentException('Invalid URI: http|https scheme required');
        }

        $endpoint = $grantRoute;

        $http = new Client(config('demo_app.http_options'));

        $tokenResponse = $http->request('POST', $endpoint, ['form_params' => $query]);
        $json = json_decode($tokenResponse->getBody()->getContents(), true);

        if (isset($json['access_token'])) {
            $requestResourceRoute = $this->container->router->pathFor('requestResource.request_resource');
            $data = [
                'response' => $json,
                'request_resource_url' => $requestResourceRoute.'?token='.$json['access_token']
            ];

            return $this->render($response, 'client/token/show_access_token.twig', $data);
        }

        $data = ['response' => $json ?: $tokenResponse];

        return $this->render($response, 'client/token/failed_token_request.twig', $data);
    }

    /**
     * Request token with user credentials.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return mixed
     */
    public function requestTokenWithUserCredentials(Request $request, Response $response, $args)
    {
        $username = $request->getParam('username');
        $password = $request->getParam('password');

        // exchange user credentials for access token
        $query = array(
            'grant_type'    => 'password',
            'client_id'     => config('demo_app.client_id'),
            'client_secret' => config('demo_app.client_secret'),
            'username'      => $username,
            'password'      => $password,
        );

        $endpoint = config('demo_app.token_route');
        if (0 !== strpos($endpoint, 'http')) {
            throw new InvalidArgumentException('Invalid URI: http|https scheme required');
        }

        $http = new Client(config('demo_app.http_options'));

        $tokenResponse = $http->request('POST', $endpoint, ['form_params' => $query]);
        $json = json_decode($tokenResponse->getBody()->getContents(), true);

        if (isset($json['access_token'])) {
            $requestResourceRoute = $this->container->router->pathFor('requestResource.request_resource');
            $requestResourceUrl = $requestResourceRoute.'?token='.$json['access_token'];

            $data = ['response' => $json, 'request_resource_url' => $requestResourceUrl];

            return $this->render($response, 'client/token/show_access_token.twig', $data);
        }

        $data = ['response' => $json ?: $tokenResponse];

        return $this->render($response, 'client/token/failed_token_request.twig', $data);
    }
}
