<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/12/8.
 */

namespace App\Controllers\Server;

use Slim\Http\Request;
use Slim\Http\Response;

class ResourceController extends ServerController
{
    /**
     * This is called by the client app once the client has obtained an access
     * token for the current user.  If the token is valid, the resource (in this
     * case, the "friends" of the current user) will be returned to the client.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return static
     */
    public function resource(Request $request, Response $response, $args)
    {
        $server = $this->connect();

        if (!$server->verifyResourceRequest($this->oauthRequest, $this->oauthResponse)) {
            $errors = json_decode($server->getResponse()->getContent(), true);

            return $response->withJson($errors);
        }

        // return a fake API response - not that exciting
        // @TODO return something more valuable, like the name of the logged in user
        $apiResponse = [
            'friends' => ['john', 'matt', 'jane'],
        ];

        return $response->withJson($apiResponse);
    }
}
