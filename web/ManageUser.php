<?php
session_start();
ob_start();

// Подключение файлов
error_reporting(E_ALL);
ini_set('display_errors',1);
require __DIR__ . '/../vendor/autoload.php';


// View

if (@!empty($_COOKIE['login'])) {
    if (array_key_exists('privilege', $_SESSION)) {
    } else {
        @$_SESSION['privilege'] = \liw\mvc\Controller\Profile\ProfileFunction\Privilege\CheckPrivilege::getPermission($_COOKIE['login']);
    }
    if ($_SESSION['privilege'] == 'admin') {
        require_once __DIR__ . '/../mvc/View/Profile/Privilege/SetPrivilege.php';
    } else {
        die("Вы не имеете доступа на эту страницу!");
    }
} else {
    die("Вы не имеете доступа на эту страницу!");
}


// Controller

if (!empty($_COOKIE['login'])) {
    $refUser = new liw\mvc\Controller\Profile\Authorization\LoginIn();
    $refUser->getPassword();
    $checkRealUser = $refUser->refPassword();
} else {
    $checkRealUser = null;
}

if (isset($_POST['admin']) && !empty($_COOKIE['login'])) {
    $changePrivilege = new \liw\mvc\Controller\Profile\ProfileFunction\Privilege\ChangePrivilege();
    $changePrivilege->checkPrivilege($_POST['nickname'], $_POST['admin'], $_SESSION['privilege']);
} else if (isset($_POST['moderator'])) {
    $changePrivilege = new \liw\mvc\Controller\Profile\ProfileFunction\Privilege\ChangePrivilege();
    $changePrivilege->checkPrivilege($_POST['nickname'], $_POST['moderator'], $_SESSION['privilege']);
} else if (isset($_POST['user'])) {
    $changePrivilege = new \liw\mvc\Controller\Profile\ProfileFunction\Privilege\ChangePrivilege();
    $changePrivilege->checkPrivilege($_POST['nickname'], $_POST['user'], $_SESSION['privilege']);
}


