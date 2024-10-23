<?php

namespace Palmo\controller;

use Palmo\service\PreferenceService;

class PreferenceController
{
    private PreferenceService $service;
    public function __construct(){
        $this->service = new PreferenceService();
    }
    public function handleRequest(): void
    {
        if (isset($_POST['profile-update'])) {
            $this->service->save();
        }
    }
}