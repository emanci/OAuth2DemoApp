<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/16.
 */

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class PhotoController extends BaseController
{
    public function index(Request $request, Response $response, $args)
    {
        echo 'index';

        //echo "<pre>";
        //var_dump($request->getParams());

        $controller = controller('App\Controllers\AccountController');
        echo $controller->handle();
    }

    public function create()
    {
        echo 'create';
    }

    public function store()
    {
        echo 'store';
    }

    public function show()
    {
        echo 'show';
    }

    public function edit()
    {
        echo 'edit';
    }

    public function update()
    {
        echo 'update';
    }

    public function destroy()
    {
        echo 'destroy';
    }
}
