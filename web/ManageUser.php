<?php
ob_start();

// Подключение файлов
error_reporting(E_ALL);
ini_set('display_errors',1);
require __DIR__ . '/../vendor/autoload.php';

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
    $privilege = \liw\mvc\Controller\Profile\ProfileFunction\Privilege\CheckPrivilege::getPermission($_COOKIE['login']);
    $changePrivilege->checkPrivilege($_POST['nickname'], $_POST['admin'], $privilege);
} else if (isset($_POST['moderator'])) {
    $changePrivilege = new \liw\mvc\Controller\Profile\ProfileFunction\Privilege\ChangePrivilege();
    $privilege = \liw\mvc\Controller\Profile\ProfileFunction\Privilege\CheckPrivilege::getPermission($_COOKIE['login']);
    $changePrivilege->checkPrivilege($_POST['nickname'], $_POST['moderator'], $privilege);
} else if (isset($_POST['user'])) {
    $changePrivilege = new \liw\mvc\Controller\Profile\ProfileFunction\Privilege\ChangePrivilege();
    $privilege = \liw\mvc\Controller\Profile\ProfileFunction\Privilege\CheckPrivilege::getPermission($_COOKIE['login']);
    $changePrivilege->checkPrivilege($_POST['nickname'], $_POST['user'], $privilege);
}

// View

if (!empty($_COOKIE['login'])) {
    $privilege = \liw\mvc\Controller\Profile\ProfileFunction\Privilege\CheckPrivilege::getPermission($_COOKIE['login']);
    if ($privilege == 'admin') {
        require_once __DIR__ . '/../mvc/View/Profile/Privilege/SetPrivilege.php';
    } else {
        die("Вы не имеете доступа на эту страницу!");
    }
} else {
    die("Вы не имеете доступа на эту страницу!");
}


