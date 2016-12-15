<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/30.
 */

namespace App\Controllers\Server;

use Slim\Http\Request;
use Slim\Http\Response;
use GuzzleHttp\json_decode;

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

        if (!$server->validateAuthorizeRequest($this->oauthRequest, $this->oauthResponse)) {

            $errors = json_decode($server->getResponse()->getContent(), true);

            return $response->withJson($errors);
        }

        $path = $this->container->get('router')->pathFor('authorize.authorize_post');

        $responseType = $request->getParam('response_type');
        $clientId = $request->getParam('client_id');
        $redirectUri = $request->getParam('redirect_uri');
        $state = $request->getParam('state');

        $params = [
            'client_id'     => $clientId,
            'redirect_uri'  => $redirectUri,
            'response_type' => $responseType,
            'state'         => $state,
        ];

        if ($scope = $request->getParam('scope')) {
            $params['scope'] = $scope;
        }

        if ($nonce = $request->getParam('nonce')) {
            $params['nonce'] = $nonce;
        }

        $query = http_build_query($params);
        $authorizePost = $path.'?'.$query;

        $data = [
            'client_id'      => $clientId,
            'response_type'  => $responseType,
            'authorize_post' => $authorizePost,
        ];

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

        // call the oauth server and return the response
        $oauthResponse = $server->handleAuthorizeRequest($this->oauthRequest, $this->oauthResponse, $authorized);

        $statusCode = $oauthResponse->getStatusCode();
        if ($statusCode != 302) {
            $errors = json_decode($oauthResponse->getContent(), true);

            return $response->withJson($errors);
        }

        $redirectUrl = $oauthResponse->headers->get('location');

        return $response->withRedirect($redirectUrl);
    }
}
