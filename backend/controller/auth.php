<?php

use Palmo\remember\RememberMeService;
use Palmo\repository\UserRepository;
use Palmo\validation\Validator;

session_start();
require "../vendor/autoload.php";

if (isset($_POST['login']) && $_POST['login']) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $emailValidator = new Validator('email', $email);
    $userRepository = new UserRepository();
    $rememberMe  = isset($_POST['rememberMe']);
    if (!$emailValidator->validate()) {
        $_SESSION['errors'] = "Incorrect email";
        header("Location: ../views/login.php");
        exit();
    }
    $_SESSION['email'] = $email;
    $user = $userRepository->findByEmail($email);
    if ($user->isCorrectUser()) {
        if (password_verify($password, $user->getPassword())) {
            session_unset();
            $_SESSION['userId'] = $user->getId();
            if($rememberMe){
                $rememberService = new RememberMeService();
                $token = $rememberService->generateToken();

                $rememberService->saveToken($user->getId(), $token);
                setcookie('rememberMe', $token, time() + (86400 * 1), "/");
            }
            header("Location: ../views/profile.php");
            exit();
        } else {
            $_SESSION['errors'] = "Incorrect password";
            header("Location: ../views/login.php");
            exit();
        }
    } else {
        $_SESSION['errors'] = "Email not found";
        header("Location:../views/login.php");
        exit();
    }
}
if (isset($_POST['signup']) && $_POST['signup']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nameValidator = new Validator('number', $name);
    $emailValidator = new Validator('email', $email);
    $passwordValidator = new Validator('password', $password);
    $errors = '';
    if ($nameValidator->validate()) {
        $errors = 'Incorrect name';
    }
    if (!$emailValidator->validate()) {
        $errors .= '<br/>Incorrect email';
    }
    if (!$passwordValidator->validate()) {
        $errors .= '<br/>Password must be at least 5 characters';
    }
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location:../views/sign-up.php");
        exit();
    }
    $_SESSION['$name'] = $name;
    $_SESSION['email'] = $email;

    $userRepository = new UserRepository();
    $user = $userRepository->findByEmail($email);
    if ($user->isCorrectUser()) {
        $_SESSION['errors'] = 'Account with this email already exists';
        header("Location:../views/sign-up.php");
        exit();
    }
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $userRepository->save($name, $email, $passwordHash);
    $newUser = $userRepository->findByEmail($email);
    session_unset();
    $_SESSION['userId'] = $newUser->getId();
    header("Location: ../views/profile.php");
    exit();
}
if (isset($_POST['logout']) && $_POST['logout']) {
    session_unset();
    session_destroy();
    if(isset($_COOKIE['rememberMe'])){
        setcookie('rememberMe', '', time() - 3600, "/");
    }
    header("Location:../index.php");
    exit();
}