<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/12/5.
 */

namespace App\Controllers\Server;

use Slim\Http\Request;
use Slim\Http\Response;

class TokenController extends ServerController
{
    /**
     * Handle token request.
     *
     * @return OAuth2Response|\OAuth2\ResponseInterface
     */
    public function token(Request $request, Response $response, $args)
    {
        $server = $this->connect();

        // let the oauth2-server-php library do all the work!
        $oauthResponse = $server->handleTokenRequest($this->oauthRequest, $this->oauthResponse);
        $content = \GuzzleHttp\json_decode($oauthResponse->getContent(), true);

        return $response->withJson($content);
    }

    public function test(Request $request, Response $response, $args)
    {
        //file_put_contents('./900.log', ['data' => var_export($request->getParams(), true)]);

        return $response->withJson(['aa' => 'test']);
    }
}
