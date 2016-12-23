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
        if (!$code = $request->getParam('code')) {
            
            $retData = ['response' => $request->getParams()];

            return $this->render($response, '/client/authorization_code/failed_authorization.twig', $retData);
        }

        // verify the "state" parameter matches this user's session (this is like CSRF - very important!!)
        if ($request->getParam('state') !== session_id()) {

            $retData = ['response' => ['error_description' => 'Your session has expired.  Please try again.']];

            return $this->render($response, '/client/authorization_code/failed_authorization.twig', $retData);
        }

        $path = $this->container->router->pathFor('requestToken.request_token_with_authcode');
        $requestTokenUrl = $path.'?code='.$code;

        if ($showRefreshToken = $request->getParam('show_refresh_token')) {
            $requestTokenUrl .= '&show_refresh_token='.$showRefreshToken;
        }

        return $this->render(
            $response,
            '/client/authorization_code/show_authorization_code.twig',
            ['code' => $code, 'request_token_url' => $requestTokenUrl]
        );
    }
}
