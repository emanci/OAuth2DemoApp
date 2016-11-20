<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/13.
 */

namespace app\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class SomeServiceFacade extends BaseFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'some';
    }
}
