<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/22.
 */

namespace app\Controllers\Client;

use App\Controllers\BaseController;
use App\OAuth2\Client;
use App\OAuth2\GrantTypes\GrantManager;
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
        // http://www.ruanyifeng.com/blog/2014/05/oauth_2_0.html
        $grantManager = new GrantManager();
        $url = $grantManager->createURL(
            ['authorization_code', 'refresh_token', 'implicit', 'user_credentials', 'openid_connect']
        );

        $this->render($response, '/client/index.twig', $url);
    }
}
