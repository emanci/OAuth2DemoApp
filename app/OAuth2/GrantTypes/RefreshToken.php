<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/29.
 */

namespace App\OAuth2\GrantTypes;

class RefreshToken implements GrantInterface
{
    public function url()
    {
        $authorizeRoute = config('demo_app.authorize_route');

        $query = http_build_query(
            [
                'response_type' => 'code',
                'client_id'     => 'demoapp2',
                'redirect_uri'  => 'http://local.oauth2.com/oauth2/client/receive_authcode?show_refresh_token=1',
                'state'         => session_id(),
            ]
        );

        return $authorizeRoute.'?'.$query;
    }
}
