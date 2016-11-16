<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/15.
 */
namespace App\Controllers;

class AccountController extends BaseController
{
    public function index($request, $response, $args)
    {
        echo $response;
        echo "Index.";
    }

    public function handle()
    {
        echo "<br/>Handle method.";
    }
}
