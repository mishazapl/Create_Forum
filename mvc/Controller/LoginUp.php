<?php

namespace liw\mvc\Controller;

use liw\mvc\Model\Users;

class LoginUp
{
    private $login;
    private $password;
    private $age;
    private $user;

    /**
     * Проверяем все ли значения были указаны пользователем
     * При регистрации.
     */

    public function emptyRegForm()
    {
            $this->login    = trim(htmlspecialchars($_POST['log']));
            $this->password = trim(htmlspecialchars($_POST['pass']));
            if (
                !empty($this->login)
                &&
                !empty($this->password)
            ) {
                $this->checkLength();
            }
    }

    /**
     * Проверяем длинну строк.
     */

    private function checkLength()
    {
        if (
            mb_strlen($this->login) > '3'
            &&
            mb_strlen($this->login) < '32'
            &&
            mb_strlen($this->password) > '3'
            &&
            mb_strlen($this->password) < '32'
        ) {
            $this->getAge();
        } else {
            print 'Не менее 3 символов - login?Password не более 32';
        }
    }

    /**
     * Разбиваем дату рождения на массив, записываем значения в переменные
     * и вычисляем возраст человека.
     */
    private function getAge()
    {
        if (
            preg_match(
            '/(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-](19|20)\d\d/',
            $_POST['age']
            )
        ) {
            $age = $_POST['age'];
            $age = explode('-', $age);
            $day = $age[0];
            $month = $age[1];
            $year = $age[2];
            function getAge($y, $m, $d) {
                if(
                    $m > date('m')
                    ||
                    $m == date('m')
                    &&
                    $d > date('d')
                ) {
                    return (date('Y') - $y - 1);
                } else {
                    return (date('Y') - $y);
                }
            }
            $this->age = getAge($year,$month,$day);
            $this->checkAge();
        } else {
            print 'Вы допустили ошибку во время укания даты рождения!';
        }
    }

    /**
     * Проверяем возраст человека.
     */

    private function checkAge()
    {
        if (
            (int)$this->age > 5
            &&
            (int)$this->age < 80
        ) {
            $this->age = $_POST['age'];
            $this->sendDataRegistration();
        } elseif ((int)$this->age > 80) {
            print 'You old';
        } elseif ((int)$this->age < 5) {
            print 'Too young';
        } else {
            print 'Ошибка данных!';
        }
    }

    /**
     * Отправляем данные в модель!
     */

    private function sendDataRegistration()
    {
        $model = new Users();
        $model->connectDB();
        $checkLogin = $model->refLogin($this->login);
        if ($checkLogin === true) {
            print 'Логин занят <br>';
            print '<a href="LoginUp.php" style="font-size: 40px;">Обновить страницу!</a>';
            exit();
        } else {
            $model->connectDB();
            $model->getDataRegistration($this->password,$this->age);
            $this->user     = $model->dataUser();
            $this->login    = $this->user['login'];
            $this->installCookie();
        }
    }

    public function installCookie()
    {
        if (!empty($this->login)) {
            setcookie
            (
                "login",
                "$this->login",
                time()+3680
            );
            print 'Вы успешно зарегистрировались!';
            print '<a href="index.php">Главная</a>';
            exit();
        } else {
            print 'Неизвестная ошибка, обратитесь к администратору!';
        }
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
        if ($this->user['login'] === $_COOKIE['login']) {
            return true;
        } else {
            print 'Войдите заново в систему!';
            return false;
        }
    }
}