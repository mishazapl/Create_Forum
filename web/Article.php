<?php

// Подключение файлов
error_reporting(E_ALL);
ini_set('display_errors',1);
require __DIR__ . '/../vendor/autoload.php';

/*
 * Значения по умолчанию для переменных.
 */
$headerArticle = null;
$article       = null;
$privilege     = null;

// Model


// Controller




// View

if (!empty($_COOKIE['login'])) {
   $privilege = \liw\mvc\Controller\CheckPrivilege::getPermission($_COOKIE['login']);
}

require_once __DIR__ . '/../mvc/View/ArticleView.php';