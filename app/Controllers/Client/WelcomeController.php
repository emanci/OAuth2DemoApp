<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/22.
 */

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\OAuth2\Client;
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
        $authorizeClient = new Client();
        $authorizeUrl = $authorizeClient->authorize();
        $refreshAuthorizeUrl = $authorizeClient->refreshAuthorize();

        $data = [
            'authorize_url'         => $authorizeUrl,
            'refresh_authorize_url' => $refreshAuthorizeUrl,
        ];

        $this->render($response, '/client/index.twig', $data);
    }
}
