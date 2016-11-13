<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/6.
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'oauth_users';

    /**
     * Test facades.
     */
    public function test()
    {
        echo "test method";
    }

    public function aliasesTest()
    {
        echo 'aliases Test';
    }
}