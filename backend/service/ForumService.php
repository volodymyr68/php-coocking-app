<?php

namespace Palmo\service;

use JetBrains\PhpStorm\NoReturn;
use Palmo\repository\ForumRepository;
use Palmo\validation\Validator;

class ForumService
{
    #[NoReturn] public function create(): void
    {
        $message = $_POST['message'];
        $userID = $_SESSION['userId'];
        $forumRepository = new ForumRepository();
        $stringValidator = new Validator('string', $message);
        if ($stringValidator->validate()) {
            $forumRepository->addMessage($message, $userID);
            header("Location:../views/forum.php");
            exit();
        }
        $_SESSION['error'] = "Invalid message";
        header("Location:../views/forum.php");
        exit();
    }
}