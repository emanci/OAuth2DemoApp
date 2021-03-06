<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/29.
 */

namespace App\Controllers\Server;

use App\Controllers\BaseController;
use OAuth2\OpenID\GrantType\AuthorizationCode;
use OAuth2\GrantType\RefreshToken;
use OAuth2\GrantType\UserCredentials;
use OAuth2\Server as OAuth2Server;
use OAuth2\HttpFoundationBridge\Response as BridgeResponse;
use OAuth2\HttpFoundationBridge\Request as BridgeRequest;
use OAuth2\Storage\Memory;
use OAuth2\Storage\Pdo;

/**
 * Authorization server.
 * Class ServerController
 */
class ServerController extends BaseController
{
    /**
     * @var
     */
    protected $oauthRequest;

    /**
     * @var
     */
    protected $oauthResponse;

    /**
     * Connet OAuth2 server.
     *
     * @return OAuth2Server
     */
    public function connect()
    {
        return $this->setUp();
    }

    /**
     * Setup OAuth2 server.
     *
     * @return OAuth2Server
     */
    protected function setUp()
    {
        $dsn = 'mysql:dbname=oauth2_app;host=localhost';
        $username = 'root';
        $password = 'root';

        // create PDO-based sqlite storage
        $storage = new Pdo(['dsn' => $dsn, 'username' => $username, 'password' => $password]);

        // create array of supported grant types
        $grantTypes = [
            'authorization_code' => new AuthorizationCode($storage),
            'user_credentials'   => new UserCredentials($storage),
            'refresh_token'      => new RefreshToken(
                $storage, [
                    'always_issue_new_refresh_token' => true,
                ]
            ),
        ];

        // instantiate the oauth server
        $server = new OAuth2Server(
            $storage,
            [
                'enforce_state'      => true,
                'allow_implicit'     => true,
                'use_openid_connect' => true,
                'issuer'             => $_SERVER['HTTP_HOST'],
            ],
            $grantTypes
        );

        $server->addStorage($this->getKeyStorage(), 'public_key');

        $this->oauthRequest = BridgeRequest::createFromGlobals();
        $this->oauthResponse = new BridgeResponse();

        return $server;
    }

    /**
     * Get key storage.
     *
     * @return Memory
     */
    private function getKeyStorage()
    {
        $publicKey = file_get_contents(APP_PATH.'/data/pubkey.pem');
        $privateKey = file_get_contents(APP_PATH.'/data/privkey.pem');

        // create storage
        $keyStorage = new Memory(
            [
                'keys' => [
                    'public_key'  => $publicKey,
                    'private_key' => $privateKey,
                ],
            ]
        );

        return $keyStorage;
    }
}
