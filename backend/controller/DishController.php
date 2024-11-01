<?php

namespace Palmo\controller;

use Palmo\service\DishService;

class DishController
{
    private DishService $service;
    public function __construct(){
        $this->service = new DishService();
    }
    public function handleRequest(): void
    {
        if (isset($_POST['method']) && ($_POST['method'] === 'save' || $_POST['method'] === 'save-random')) {
            $this->service->save();
        }
        if (isset($_POST['method']) && $_POST['method'] === 'delete') {
            $this->service->delete();
        }
        if (isset($_POST['method']) && $_POST['method'] === 'searchByName') {
            $this->service->searchByName();
        }
    }
}