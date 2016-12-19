<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/29.
 */

namespace App\OAuth2\GrantTypes;

class OpenIDConnect implements GrantInterface
{
    public function url()
    {
        $authorizeRoute = config('demo_app.authorize_route');

        $query = http_build_query(
            [
                'response_type' => 'code',
                'client_id'     => config('demo_app.client_id'),
                'redirect_uri'  => 'http://local.oauth2.com/oauth2/client/receive_authcode',
                'scope'         => 'openid',
                'state'         => session_id(),
                'nonce'         => rand(0, 9999),
            ]
        );

        $authorizationCodeWithIdTokenQuery = http_build_query(
            [
                'response_type' => 'code id_token',
                'client_id'     => config('demo_app.client_id'),
                'redirect_uri'  => 'http://local.oauth2.com/oauth2/client/receive_authcode',
                'scope'         => 'openid',
                'state'         => session_id(),
                'nonce'         => rand(0, 9999),
            ]
        );

        $implicitQuery = http_build_query(
            [
                'response_type' => 'id_token token',
                'client_id'     => 'demoapp3',
                'redirect_uri'  => 'http://local.oauth2.com/oauth2/client/receive_implicit_token',
                'scope'         => 'openid',
                'state'         => session_id(),
                'nonce'         => rand(0, 9999),
            ]
        );

        $authorizationCodeUrl = $authorizeRoute.'?'.$query;
        $authorizationCodeWithIdTokenUrl = $authorizeRoute.'?'.$authorizationCodeWithIdTokenQuery;
        $implicitUrl = $authorizeRoute.'?'.$implicitQuery;

        $openidConnect = [
            'authorization_code_url'               => $authorizationCodeUrl,
            'authorization_code_with_id_token_url' => $authorizationCodeWithIdTokenUrl,
            'implicit_url'                         => $implicitUrl,
        ];

        return $openidConnect;
    }
}
