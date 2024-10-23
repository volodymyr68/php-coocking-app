<?php

use Palmo\controller\AuthController;
use Palmo\controller\DishController;
use Palmo\controller\ForumController;
use Palmo\controller\PreferenceController;

require "../vendor/autoload.php";
session_start();



$authController = new AuthController();
$authController->handleRequest();

$dishController = new DishController();
$dishController->handleRequest();

$forumController = new ForumController();
$forumController->handleRequest();

$preferenceController = new PreferenceController();
$preferenceController->handleRequest();