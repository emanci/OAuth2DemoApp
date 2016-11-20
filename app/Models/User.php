<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/6.
 */

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'oauth_users';

    /**
     * Test facades.
     */
    public static function test()
    {
        echo 'test method';
    }

    public function aliasesTest()
    {
        echo 'aliases Test';
    }
}
