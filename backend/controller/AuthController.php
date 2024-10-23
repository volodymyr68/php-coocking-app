<?php

namespace Palmo\controller;

use Palmo\service\AuthService;

class AuthController extends BaseController
{
    private AuthService $service;
    public function __construct(){
        $this->service = new AuthService();
    }
    public function handleRequest(): void
    {
        if (isset($_POST['login']) && $_POST['login']) {
            $this->service->login();
        }
        if (isset($_POST['signup']) && $_POST['signup']) {
            $this->service->signup();
        }
        if (isset($_POST['logout']) && $_POST['logout']) {
            $this->service->logout();
        }
    }
}