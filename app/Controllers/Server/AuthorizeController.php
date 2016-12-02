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
use OAuth2\Request as OAuth2Request;
use OAuth2\Response as OAuth2Response;

class AuthorizeController extends ServerController
{
    /**
     * authorize.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return mixed|static
     */
    public function authorize(Request $request, Response $response, $args)
    {
        $server = $this->connect();

        $oauthRequest = OAuth2Request::createFromGlobals();
        $oauthResponse = new OAuth2Response();

        if (!$server->validateAuthorizeRequest($oauthRequest, $oauthResponse)) {
            $serverResponse = $server->getResponse();

            $statusCode = $serverResponse->getStatusCode();
            $errors = $serverResponse->getParameters();

            return $response->withJson(
                [
                    'code'              => $statusCode,
                    'error'             => $errors['error'],
                    'error_description' => $errors['error_description'],
                ]
            );
        }

        $path = $this->container->get('router')->pathFor('authorize.authorize_post');
        $params = $request->getParams();
        array_shift($params);
        $query = http_build_query($params);

        $data = array(
            'client_id'      => $request->getParam('client_id'),
            'response_type'  => $request->getParam('response_type'),
            'authorize_post' => $path.'?'.$query,
        );

        return $this->render($response, '/server/authorize.twig', $data);
    }

    /**
     * Authorize form submit.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return static
     */
    public function authorizeFormSubmit(Request $request, Response $response, $args)
    {
        $server = $this->connect();

        $authorized = (bool) $request->getParam('authorize');
        $oauthRequest = OAuth2Request::createFromGlobals();
        $oauthResponse = new OAuth2Response();

        // call the oauth server and return the response
        $serverResponse = $server->handleAuthorizeRequest($oauthRequest, $oauthResponse, $authorized);

        $redirectUrl = $serverResponse->getHttpHeader('Location');

        return $response->withRedirect($redirectUrl);
    }
}
