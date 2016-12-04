<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/29.
 */

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthorizationCodeController extends BaseController
{
    /**
     * Receive authorization code.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return mixed
     */
    public function receive(Request $request, Response $response, $args)
    {
        // the user denied the authorization request
        if (!$code = $request->getParam('code')) {
            return $this->render(
                $response,
                '/client/failed/failed_authorization.twig',
                ['response' => $request->getParams()]
            );
        }

        // verify the "state" parameter matches this user's session (this is like CSRF - very important!!)
        if ($request->getParam('state') !== session_id()) {
            return $this->render(
                $response,
                '/client/failed/failed_authorization.twig',
                ['response' => ['error_description' => 'Your session has expired.  Please try again.']]
            );
        }

        $path = $this->container->router->pathFor('requestToken.request_token_with_authcode');
        $requestTokenUrl = $path.'?code='.$code;

        return $this->render(
            $response,
            '/client/successful/show_authorization_code.twig',
            ['request_token_url' => $requestTokenUrl]
        );
    }
}