<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/30.
 */

namespace App\Controllers\Server;

use App\Controllers\BaseController;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthorizeController extends ServerController
{
    public function authorize(Request $request, Response $response, $args)
    {
        $this->connect();
        $server = $this->container['oauth_server'];
        //$oauthResponse = $this->container['oauth_response'];

        $oauthRequest = \OAuth2\Request::createFromGlobals();
        $oauthResponse = new \OAuth2\Response();

        //var_dump($server->validateAuthorizeRequest($oauthRequest, $oauthResponse));
        if (!$server->validateAuthorizeRequest($oauthRequest, $oauthResponse)) {
            echo "<pre>";
            print_r($server->getResponse());

            return $server->getResponse();
        }

        $data = array(
            'client_id'     => $request->getParam('client_id'),
            'response_type' => $request->getParam('response_type'),
        );

        return $this->render($response, '/server/authorize.twig', $data);
    }

    public function authorizeFormSubmit(Request $request, Response $response, $args)
    {

    }
}
