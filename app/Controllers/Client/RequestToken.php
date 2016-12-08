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

        $path = $this->container->get('router')->pathFor('authorizationCode.receive');
        $authorizeRedirect = $redirectUriParams ? $path.'?'.http_build_query($redirectUriParams) : $path;

        // exchange authorization code for access token
        $data = [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => config('demo_app.client_id'),
            'client_secret' => config('demo_app.client_secret'),
            'redirect_uri'  => 'http://local.oauth2.com'.$authorizeRedirect,
        ];

        // determine the token endpoint to call based on our config
        $endpoint = config('demo_app.token_route');
        if (0 !== strpos($endpoint, 'http')) {
            // if PHP's built in web server is being used, we cannot continue
            //$this->testForBuiltInWebServer();

            // generate the route
            //$endpoint = $urlgen->generate($endpoint, array(), true);
        }

        $http = new Client(config('demo_app.http_options'));
        $tokenResponse = $http->request('POST', $endpoint, ['form_params' => $data]);
        $json = json_decode($tokenResponse->getBody()->getContents(), true);

        if (isset($json['access_token'])) {
            $path = $this->container->router->pathFor('requestResource.request_resource');
            $requestResourceUrl = $path.'?token='.$json['access_token'];

            $data = ['response' => $json, 'request_resource_url' => $requestResourceUrl];

            if ($showRefreshToken) {
                return $this->render($response, 'client/token/show_refresh_token.twig', $data);
            }

            return $this->render($response, 'client/token/show_access_token.twig', $data);
        }

        return $this->render($response, 'client/token/failed_token_request.twig', ['response' => $json ?: $response]);
    }
}
