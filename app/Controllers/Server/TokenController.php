<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/12/5.
 */

namespace App\Controllers\Server;

use OAuth2\Request as OAuth2Request;
use OAuth2\Response as OAuth2Response;

class TokenController extends ServerController
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
     * AuthorizeController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->oauthRequest = OAuth2Request::createFromGlobals();
        $this->oauthResponse = new OAuth2Response();
    }

    /**
     * Handle token request.
     *
     * @return OAuth2Response|\OAuth2\ResponseInterface
     */
    public function token()
    {
        $server = $this->connect();

        // let the oauth2-server-php library do all the work!
        return $server->handleTokenRequest($this->oauthRequest, $this->oauthResponse);
    }
}
