<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/12/19.
 */

namespace App\OAuth2\GrantTypes;

use InvalidArgumentException;

class GrantManager
{
    /**
     * The support grant type.
     *
     * @var array
     */
    protected $supportgrantType = [
        'authorization_code' => 'AuthorizationCode',
        'refresh_token'      => 'RefreshToken',
        'implicit'           => 'Implicit',
        'user_credentials'   => 'UserCredentials',
        'openid_connect'     => 'OpenIDConnect',
    ];

    /**
     * Create grant url by type.
     *
     * @param $grantType
     *
     * @return array
     */
    public function createURL($grantType)
    {
        $url = [];
        foreach ($this->normalize($grantType) as $item) {
            $url[$item.'_url'] = $this->createGrant($item)->url();
        }

        return $url;
    }

    /**
     * Create Grant.
     *
     * @param $grantType
     *
     * @return mixed
     */
    protected function createGrant($grantType)
    {
        if (isset($this->supportgrantType[$grantType])) {
            $grant = $this->supportgrantType[$grantType];
            $grant = __NAMESPACE__.'\\'.$grant;

            return new $grant();
        }

        throw new InvalidArgumentException("Grant [$grantType] not supported.");
    }

    /**
     * Normalize grant type.
     *
     * @param $grantType
     *
     * @return array
     */
    public function normalize($grantType)
    {
        return is_array($grantType) ? $grantType : (array) $grantType;
    }
}
