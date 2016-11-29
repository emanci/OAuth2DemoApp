<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/22.
 */

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class WelcomeController extends BaseController
{
    /**
     * Home page.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     */
    public function index(Request $request, Response $response, $args)
    {
        $query = http_build_query(
            [
                'response_type' => 'code',
                'client_id'     => '',
                'redirect_uri'  => 'http://local.oauth2.com/oauth2/client/receive_authcode',
                'state'         => session_id(),
            ]
        );

        $authorizeRoute = config('demo_app.authorize_route');

        $authorizeUrl = $authorizeRoute.'?'.$query;

        $data = [
            'authorize_url' => $authorizeUrl,
        ];


        $this->render($response, '/client/index.twig', $data);
    }
}
