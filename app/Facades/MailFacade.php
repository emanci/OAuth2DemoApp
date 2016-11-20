<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/19.
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class MailFacade extends BaseFacade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mail';
    }
}
