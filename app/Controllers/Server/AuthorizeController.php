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
     * @var
     */
    protected $oauthRequest;

    /**
     * @var
     */
    protected $oauthResponse;

    /**
     * AuthorizeController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->oauthRequest = OAuth2Request::createFromGlobals();
        $this->oauthResponse = new OAuth2Response();
    }

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

        $query = http_build_query($params);
        $authorizePost = $path.'?'.$query;

        $data = array(
            'client_id'      => $clientId,
            'response_type'  => $responseType,
            'authorize_post' => $authorizePost,
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

        // call the oauth server and return the response
        $serverResponse = $server->handleAuthorizeRequest($this->oauthRequest, $this->oauthResponse, $authorized);

        $redirectUrl = $serverResponse->getHttpHeader('Location');

        return $response->withRedirect($redirectUrl);
    }
}
