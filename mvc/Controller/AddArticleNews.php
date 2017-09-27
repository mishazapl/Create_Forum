<?php

namespace liw\mvc\Controller;


use liw\mvc\Model\ArticleNews;
use liw\mvc\Model\ProfileUser;

class AddArticleNews
{
    private $creator;
    private $dataPubl;

    public function checkPrivilege($privilege)
    {
        if ($privilege != 'admin') {
            print 'Вы не админ!';
            die();
        }
    }

    public function getCreator($autologin)
    {
        $ProfileUser = new ProfileUser();
        $ProfileUser->connectBD();
        $this->creator  = $ProfileUser->getLogin($autologin);
        $this->dataPubl = date("d/m/Y");
    }

    public function addArticle($headerArticle, $article)
    {
        $ArticleNews = new ArticleNews();
        $ArticleNews->connectBD();
        $ArticleNews->prepareQuery
        (
            $headerArticle,
            $article,
            $this->creator,
            $this->dataPubl
        );
    }

    public function getArticle()
    {
        $ArticleNews = new ArticleNews();
        $ArticleNews->connectBD();
        $Article = $ArticleNews->getArticle();
        return $Article;
    }
}