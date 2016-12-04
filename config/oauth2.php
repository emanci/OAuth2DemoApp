<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/26.
 */
return [
    'lockd_in' => [
        "client_id"        => "demoapp",
        "client_secret"    => "demopass",
        "token_route"      => "grant",
        "authorize_route"  => "authorize",
        "resource_route"   => "access",
        "resource_params"  => [],
        "resource_method"  => "GET",
        "curl_options"     => [],
        "user_credentials" => [
            "demouser",
            "testpass",
        ],
        "http_options"     => [
            "exceptions" => false,
        ],
    ],
    "demo_app" => [
        "client_id"       => "demoapp",
        "client_secret"   => "demopass",
        "token_route"     => "http://local.oauth2.com/token",
        "authorize_route" => "http://local.oauth2.com/oauth2/lockdin/authorize",
        "resource_route"  => "http://local.oauth2.com/profile",
        "resource_method" => "POST",
        "resource_params" => [
            "debug" => true,
        ],
        "curl_options"    => [
            "http_port" => 443,
            "verifyssl" => false,
        ],
        "http_options"    => [
            "exceptions" => false,
        ],
    ],
];