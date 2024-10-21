<?php
require "../vendor/autoload.php";

use Palmo\repository\ForumRepository;
use Palmo\validation\Validator;

session_start();
if (!isset($_SESSION['userId'])) {
    session_unset();
    session_destroy();
    header("Location:../views/login.php");
    exit();
}
if (isset($_POST['message'])) {
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