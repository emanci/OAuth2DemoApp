<?php
/**
 * Created by PhpStorm.
 * Author: phil <zhengchaopu@gmail.com>
 * Date: 2016/11/30.
 */

namespace App\Controllers;

use App\Services\MailService;
use Interop\Container\ContainerInterface;

class UserController extends BaseController
{
    protected $mailService;

    public function __construct(ContainerInterface $container, MailService $mailService)
    {
        parent::__construct($container);
        $this->mailService = $mailService;
    }

    public function profile()
    {
        echo "Profile";
        echo "<pre>";
        print_r(get_class_methods($this->mailService));
        $this->mailService->send();
    }
}