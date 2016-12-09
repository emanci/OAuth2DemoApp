<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/30.
 */

namespace App\Controllers;

use App\OAuth2\Test;
use App\Services\MailService;
use Interop\Container\ContainerInterface;

class UserController extends BaseController
{
    protected $mailService;

    protected $repository;

    public function __construct(ContainerInterface $container, MailService $mailService, Test $test)
    {
        parent::__construct($container);
        $this->mailService = $mailService;
        $this->repository = $test;
    }

    /**
     * Test dependency.
     */
    public function profile()
    {
        echo "Profile：";
        echo "<pre>";
        print_r($this->repository->all());
        print_r(get_class_methods($this->mailService));
        $this->mailService->send();
    }
}