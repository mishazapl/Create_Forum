<?php

namespace liw\mvc\Controller;

use liw\mvc\Model\Users;

class LoginIn
{
    private $user;

    public static function unLogin($login,$password)
    {
        setcookie(
            "login",
            "$login",
            time()-5000
        );
        setcookie(
            "password",
            "$password",
            time()-5000
        );
        print "<div style='font-size: 30px; color: aquamarine; text-align: center;'>Досвидание $login</div>";
        print "<br><div style='text-align: center;'><a href='index.php' style='font-size: 20px; color: chartreuse;'>Обновить страницу</a></div>";
        exit();
    }

    /**
     * @param $login
     * @param $password
     *
     * Авторизация.
     */

    public static function loginIn($login,$password)
    {
        $model    = new Users();
        $login    = htmlspecialchars($login);
        $password = htmlspecialchars($password);
        $model->connectDB();
        $result = $model->loginIn($login,$password);
        if ($result !== false) {
            self::setCookieLoginIn($result);
        }
    }

    private static function setCookieLoginIn($result)
    {
        $login    = $result['login'];
        $password = $result['password'];
        setcookie(
            "login",
            "$login",
            time()+3680
        );
        setcookie(
            "password",
            "$password",
            time()+3680
        );
        print 'Вы успешно вошли! <br>';
        print "Привет $login <br>";
        print '<a href="index.php" style="text-align: center; font-size: 40px;">Обновить страницу</a>';
        exit();

    }

    /**
     * @param $login
     * @param $number
     *
     * Увеличения числа по кнопке +
     */

    public static function setNumber($login,$number)
    {
        $model = new Users();
        $model->connectDB();
        $model->setNumber(htmlspecialchars($login),$number);
    }

    /**
     * @param $login
     * @param $password
     * @return int
     *
     * Получение числа в View!
     */

    public static function getNumber($login,$password)
    {
        $model = new Users();
        $model->connectDB();
        $result = $model->prepareGetNumber(htmlspecialchars($login),htmlspecialchars($password));
        return (int)$result;
    }

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
        if ($this->user['password'] === $_COOKIE['password']) {
            return true;
        } else {
            print 'У вас поддельные куки!';
            exit();
        }
    }
}