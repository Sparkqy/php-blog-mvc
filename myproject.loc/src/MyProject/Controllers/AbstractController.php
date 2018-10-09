<?php
/**
 * Created by PhpStorm.
 * User: triik
 * Date: 10/3/2018
 * Time: 4:29 PM
 */

namespace MyProject\Controllers;


use MyProject\Services\UsersAuthService;
use MyProject\View\View;

class AbstractController
{
    protected $view;
    protected $user;

    public function __construct()
    {
        $this->user = UsersAuthService::getUserByToken();
        $this->view = new View(__DIR__ . '/../../../templates');
        $this->view->setExtraVars('user', $this->user);
    }
}