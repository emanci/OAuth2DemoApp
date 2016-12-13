<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/12/13.
 */

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class WeUIController extends BaseController
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     */
    public function index(Request $request, Response $response, $args)
    {
        $this->render($response, '/weui/index.twig', []);
    }
}

