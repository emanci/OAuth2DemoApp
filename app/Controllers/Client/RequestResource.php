<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/12/8.
 */

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use GuzzleHttp\Client;
use Slim\Http\Request;
use Slim\Http\Response;

class RequestResource extends BaseController
{
    /**
     * Request resource.
     *
     * @param Request  $request
     * @param Response $response
     * @param          $args
     *
     * @return mixed
     */
    public function requestResource(Request $request, Response $response, $args)
    {
        $token = $request->getParam('token');

        $apiRoute = config('demo_app.resource_route');
        $endpoint = 0 === strpos($apiRoute, 'http') ? $apiRoute : '';

        $http = new Client(config('demo_app.http_options'));

        $resourceResponse = $http->request('GET', $endpoint, ['query' => ['access_token' => $token]]);
        $json = json_decode((string) $resourceResponse->getBody(), true);

        $retResponse = $json ?: $resourceResponse;
        $resourceUri = $endpoint.'?access_token='.$token;

        $data = [
            'response'     => $retResponse,
            'resource_uri' => $resourceUri,
        ];

        return $this->render($response, 'client/resource/show_resource.twig', $data);
    }
}
