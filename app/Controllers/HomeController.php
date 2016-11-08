<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/3.
 */
namespace App\Controllers;

use App\Models\User;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends BaseController
{
    public function index(Request $request, Response $response, $args)
    {
        echo "Welcome, Friend";
    }

    public function user(Request $request, Response $response, $args)
    {
        //$user = User::find(1);
        $user = User::where('username', 'emanci')->first();

        //echo 'id:'.$user->id;
        //echo "<pre>";
        //print_r($user);
        //echo "<br/>Hello World<br/>";
        $this->render($response, '/user/profile.twig', ['nickname' => 'emanci']);
    }
}