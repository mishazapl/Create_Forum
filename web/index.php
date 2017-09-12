<?php
ob_start();

// Подключение файлов
error_reporting(E_ALL);
ini_set('display_errors',1);
require __DIR__ . '/../vendor/autoload.php';

// Controller

if (!empty($_COOKIE['login']) && !empty($_COOKIE['password'])) {
    $refUser = new liw\mvc\Controller\LoginIn();
    $refUser->getPassword();
    $checkRealUser = $refUser->refPassword();
} else {
    $checkRealUser = null;
}

if (
    isset($_POST['submit'])
    &&
    !empty($_POST['log'])
    &&
    !empty($_POST['pass'])
) {
    liw\mvc\Controller\LoginIn::loginIn($_POST['log'],$_POST['pass']);
}

if (isset($_POST['exit'])) {
    if (!empty($_COOKIE['login']) && !empty($_COOKIE['password'])) {
        \liw\mvc\Controller\LoginIn::unLogin($_COOKIE['login'],$_COOKIE['password']);
    } else {
        print 'Вы уже вышли!';
    }
}

// View

if ($checkRealUser !== true) {
    require_once __DIR__ . '/../mvc/View/LoginIn.php';
} else {
    $current = liw\mvc\Controller\LoginIn::getNumber($_COOKIE['login'],$_COOKIE['password']);
    if (isset($_POST['plus'])) {
        ++$current;
        liw\mvc\Controller\LoginIn::setNumber($_COOKIE['login'],$current);
    }
    require_once __DIR__ . '/../mvc/View/Input.php';
}

