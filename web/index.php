<?php
ob_start();

// Подключение файлов
error_reporting(E_ALL);
ini_set('display_errors',1);
require __DIR__ . '/../vendor/autoload.php';

// Controller

if (!empty($_COOKIE['login'])) {
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
    $refUser = new liw\mvc\Controller\LoginIn();
    $refUser->loginIn($_POST['log'],$_POST['pass']);
}

if (isset($_POST['exit'])) {
    if (!empty($_COOKIE['login'])) {
        $profile = new liw\mvc\Controller\Profile();
        $profile->exitUser($_COOKIE['login']);
    } else {
        print 'Вы уже вышли!';
    }
}

// View

/**
 * Вызов контроллера для загрузки изображения профиля.
 */

if (isset($_POST['load'])) {
    $profile = new liw\mvc\Controller\Profile();
    $profile->checkFormatPhoto();
}


/**
 * Если не зарегистрирован показать окно регистрации
 * Если зарегистрирован показать информацию о профиле.
 */
if ($checkRealUser !== true) {
    require_once __DIR__ . '/../mvc/View/LoginIn.php';
} else {
    $profile = new \liw\mvc\Controller\Profile();
    $profile = $profile->getDataUser($_COOKIE['login']);
    $logUser = $profile['Login'];
    $ageUser = $profile['Age'];
    $photoUser = $profile['LinkPhoto'];
    $privilege = $profile['privilege'];
    unset($profile);
    require_once __DIR__ . '/../mvc/View/Profile.php';
}

