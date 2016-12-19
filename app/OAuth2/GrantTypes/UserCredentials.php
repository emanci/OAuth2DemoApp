<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/29.
 */

namespace App\OAuth2\GrantTypes;

class UserCredentials implements GrantInterface
{
    public function url()
    {
        $authorizeRoute = '/oauth2/client/request_token/user_credentials';
        $userCredentials = config('demo_app.user_credentials');

        $query = http_build_query(
            [
                'username' => $userCredentials[0],
                'password' => $userCredentials[1],
            ]
        );

        return $authorizeRoute.'?'.$query;
    }
}
