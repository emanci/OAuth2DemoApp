<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/28.
 */

namespace App\OAuth2\GrantTypes;

interface GrantInterface
{
    /**
     * @return mixed
     */
    public function url();
}
