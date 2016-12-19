<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/29.
 */

namespace App\OAuth2\GrantTypes;

class Implicit implements GrantInterface
{
    public function url()
    {
        $authorizeRoute = config('demo_app.authorize_route');

        $query = http_build_query(
            [
                'response_type' => 'token',
                'client_id'     => 'demoapp3',
                'redirect_uri'  => 'http://local.oauth2.com/oauth2/client/receive_implicit_token',
                'state'         => session_id(),
            ]
        );

        return $authorizeRoute.'?'.$query;
    }
}
