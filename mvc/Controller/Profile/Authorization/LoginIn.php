<?php

namespace liw\mvc\Controller\Profile\Authorization;

use liw\mvc\Model\Profile\Users;

class LoginIn
{
    private $user;

    /**
     * @param $login
     * @param $password
     *
     * Авторизация.
     */

    public function loginIn($login,$password)
    {
        $model = new Users();
        $model->connectBD();
        $result = $model->loginIn($login,$password);
        if ($result !== false) {
            $this->setCookieLoginIn($result);
        }
    }

    private function setCookieLoginIn($result)
    {
        $login = $result['autologin'];
        setcookie(
            "login",
            "$login",
            time()+3680
        );
        print 'Вы успешно вошли! <br>';
        print "Привет! Обновите страницу! <br>";
        print '<a href="index.php" style="text-align: center; font-size: 40px;">Обновить страницу</a>';
        exit();

    }

    /**
     * Проверка подлинности данных из куки!
     */

    public function getPassword()
    {
        $model = new Users();
        $model->connectBD();
        $this->user = $model->queryPassword($_COOKIE['login']);
    }

    public function refPassword()
    {
        if ($this->user['autologin'] === $_COOKIE['login']) {
            return true;
        } else {
            print 'Войдите заново в систему';
        }
    }
}