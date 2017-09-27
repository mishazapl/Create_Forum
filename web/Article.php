<?php
ob_start();

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

$getArticle = new \liw\mvc\Model\ArticleNews();
$getArticle->connectBD();
$resultArticle = $getArticle->getArticle();

// View

if (!empty($_COOKIE['login'])) {
   $privilege = \liw\mvc\Controller\CheckPrivilege::getPermission($_COOKIE['login']);
}

if (isset($_POST['addArticle'])) {
    $addArticleNews  = new \liw\mvc\Controller\AddArticleNews();
    $addArticleNews->checkPrivilege($privilege);
    $addArticleNews->getCreator($_COOKIE['login']);
    $addArticleNews->addArticle($_POST['HeaderArticle'], $_POST['Article']);
}

require_once __DIR__ . '/../mvc/View/ArticleView.php';