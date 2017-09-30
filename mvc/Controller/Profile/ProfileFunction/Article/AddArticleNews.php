<?php

namespace liw\mvc\Controller\Profile\ProfileFunction\Article;

/**
 * Переопределять первую строчку блока use на используемую модель.
 */
use liw\mvc\Model\Article\ArticleNews;
use liw\mvc\Model\Profile\ProfileUser;

class AddArticleNews extends SettingArticle
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

    /**
     * @param $headerArticle
     * @param $article
     *
     * Создать статью, объект переопределять в дочерним классе.
     */

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

    /**
     * @return mixed
     *
     * Получение статей, объект переопределять в дочернем классе
     */

    public function getArticle()
    {
        $ArticleNews = new ArticleNews();
        $ArticleNews->connectBD();
        $Article = $ArticleNews->getArticle();
        return $Article;
    }
}