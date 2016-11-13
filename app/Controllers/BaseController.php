<?php
/**
 * Created by PhpStorm.
 * Author: PhilPu <zhengchaopu@gmail.com>
 * Date: 2016/11/3.
 */
namespace App\Controllers;

use Interop\Container\ContainerInterface;
use Slim\Http\Response;

abstract class BaseController
{
    /**
     * @var ContainerInterface
     */
    protected $app;

    /**
     * BaseController constructor.
     *
     * @param ContainerInterface $app
     */
    public function __construct(ContainerInterface $app)
    {
        $this->app = $app;
    }

    /**
     * Get app container.
     *
     * @return ContainerInterface
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Render the template.
     *
     * @param $response
     * @param $template
     * @param $data
     *
     * @return mixed
     */
    public function render(Response $response, $template, array $data = [])
    {
        return $this->app->view->render($response, $template, $data);
    }
}
