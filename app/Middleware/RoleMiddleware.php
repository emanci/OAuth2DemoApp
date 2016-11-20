<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/7.
 */

namespace App\Middleware;

use App\Foundation\Middleware;

class RoleMiddleware extends Middleware
{
    /**
     * @param $request
     * @param $response
     * @param $next
     *
     * @return mixed
     */
    public function __invoke($request, $response, $next)
    {
        //$response->getBody()->write('Role BEFORE.');
        $response = $next($request, $response);

        //$response->getBody()->write('Role AFTER.');

        return $response;
    }
}
