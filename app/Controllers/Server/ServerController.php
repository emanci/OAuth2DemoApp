<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/29.
 */

namespace App\Controllers\Server;

use App\Controllers\BaseController;
use Slim\Http\Request;
use Slim\Http\Response;

class ServerController extends BaseController
{
    public function connect(Request $request, Response $response, $args)
    {
        echo "Server";
    }
}
