<?php

namespace liw\mvc\Controller;

use liw\mvc\Model\Users;

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
        $model->connectDB();
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
     * @param $login
     * @param $number
     *
     * Увеличения числа по кнопке +
     */

    /**
     * Проверка подлинности пароля из куки!
     */

    public function getPassword()
    {
        $model = new Users();
        $model->connectDB();
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