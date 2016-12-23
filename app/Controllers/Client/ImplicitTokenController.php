<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/30.
 */

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class ImplicitTokenController extends BaseController
{
    /**
     * receive implicit token.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return mixed
     */
    public function receive(Request $request, Response $response, $args)
    {
        if ($request->getParam('error')) {
            $params = $request->getParams();

            return $this->render($response, 'client/token/failed_token_request.twig', ['response' => $params]);
        }

        // nothing to do - implicit tokens are in the URL Fragment, so it must be done by the browser
        $requestResourceRoute = $this->container->router->pathFor('requestResource.request_resource');
        
        $data = ['request_resource_route' => $requestResourceRoute];

        return $this->render($response, 'client/token/show_implicit_token.twig', $data);
    }
}
