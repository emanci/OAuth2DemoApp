<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/12/4.
 */

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use GuzzleHttp\Client;
use Slim\Http\Request;
use Slim\Http\Response;

class RequestToken extends BaseController
{
    public function requestTokenWithAuthCode(Request $request, Response $response, $args)
    {
        $code = $request->getParam('code');

        $redirectUriParams = array_filter(['show_refresh_token' => $request->getParam('show_refresh_token')]);

        $path = $this->container->get('router')->pathFor('authorizationCode.receive');
        $authorizeRedirect = $redirectUriParams ? $path.'?'.http_build_query($redirectUriParams) : $path;

        // exchange authorization code for access token
        $query = [
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'client_id'     => config('demo_app.client_id'),
            'client_secret' => config('demo_app.client_secret'),
            'redirect_uri'  => $authorizeRedirect,
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
        $response = $http->request('POST', $endpoint, $query);

        $json = json_decode((string) $response->getBody(), true);

        if (isset($json['access_token'])) {
            die('Successful!');
            if ($request->getParam('show_refresh_token')) {
                return $this->render($response, 'client/show_refresh_token.twig', ['response' => $json]);
            }

            return $this->render($response, 'client/show_access_token.twig', ['response' => $json]);
        }

        die('Failed');

        return $this->render($response, 'client/failed_token_request.twig', ['response' => $json ? $json : $response]);
    }

}
