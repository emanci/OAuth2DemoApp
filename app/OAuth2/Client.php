<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/12/4.
 */

namespace App\OAuth2;

class Client
{
    /**
     * Make an authorize url.
     *
     * @return string
     */
    public function authorize()
    {
        $authorizeRoute = config('demo_app.authorize_route');

        $query = http_build_query(
            [
                'response_type' => 'code',
                'client_id'     => config('demo_app.client_id'),
                'redirect_uri'  => 'http://local.oauth2.com/oauth2/client/receive_authcode',
                'state'         => session_id(),
            ]
        );

        return $authorizeRoute.'?'.$query;
    }

    /**
     * Make a refresh authorize url.
     *
     * @return string
     */
    public function refreshAuthorize()
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

    /**
     * Make an implicit authorize url.
     *
     * @return string
     */
    public function implicitAuthorize()
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

    /**
     * Make a user credentials.
     *
     * @return string
     */
    public function userCredentials()
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

    /**
     * Make a url array.
     *
     * @return array
     */
    public function openidConnect()
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
