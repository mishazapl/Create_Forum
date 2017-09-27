<?php
/**
 * Created by PhpStorm.
 * User: Programming_2
 * Date: 27.09.2017
 * Time: 12:14
 */

namespace liw\mvc\Controller;


class AddArticleNews
{

    public function checkPrivilege($privilege)
    {
        if ($privilege != 'admin') {
            print 'Вы не админ!';
            die();
        }
    }

    public function addArticle()
    {

    }
}