<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/3.
 */
namespace App\Controllers;

use App\Models\User;
use App\Support\Log;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Facades\SomeServiceFacade;

class HomeController extends BaseController
{
    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     */
    public function index(Request $request, Response $response, $args)
    {
        echo "Welcome, Friend";
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     */
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

    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     */
    public function some(Request $request, Response $response, $args)
    {
        //echo SomeServiceFacade::aliasesTest();
        //echo FuckName::aliasesTest();
        //var_dump($this->getApp()->some);
        //echo "<pre>";
        //print_r(get_class_methods($this->app->get('some')));

        // test
        $controller = new AccountController($this->app);
        //$account->handle();
        call_user_func_array($controller('index'), ['aa', 'bb', ['cc']]);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param          $args
     */
    public function log(Request $request, Response $response, $args)
    {
        echo "Log:<br/>";
        echo Log::error('API response:', ['aa' => 'aa', 'bb' => 'bb']);
        echo Log::error('API response:', ['cc' => 'cc', 'dd' => 'dd']);
        echo Log::info('API response:', ['ee' => 'ee', 'ff' => 'ff']);
        echo Log::info('API response:', ['aaaaaaaa']);

    }
}
