<?php

namespace Palmo\controller;

use Palmo\service\ForumService;

class ForumController
{
    private ForumService $service;
    public function __construct(){
        $this->service = new ForumService();
    }
    public function handleRequest(): void
    {
        if (isset($_POST['message'])) {
            $this->service->create();
        }
    }
}