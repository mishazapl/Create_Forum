<?php
ob_start();

// Подключение файлов
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once __DIR__ . '/../vendor/autoload.php';

// Controller

if (
    isset($_POST['sub'])
    &&
    !empty($_POST['log'])
    &&
    !empty($_POST['pass'])
    &&
    !empty($_POST['age'])
) {
    $loginUp   = new liw\mvc\Controller\Profile\Authorization\LoginUp();
    $loginUp->emptyRegForm();
}

if (!empty($_COOKIE['login'])) {
    $refUser = new liw\mvc\Controller\Profile\Authorization\LoginUp();
    $refUser->getPassword();
    $checkRealUser = $refUser->refPassword();
} else {
    $checkRealUser = null;
}

// View

if ($checkRealUser !== true) {
    require_once __DIR__ . '/../mvc/View/Profile/LoginUp.php';
} else {
    print 'Поздравляю, вы зарегистрированы, переходите на главную';
    print '<br> <a href="index.php">Главная</a> ';
}





