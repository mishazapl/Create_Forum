<?php

namespace liw\mvc\Model;

class Users
   extends SettingModel // !!!
{
    private $host  = 'localhost';
    private $user  = 'root';
    private $pass  = '';
    private $bd    = 'user';
    private $mysqli;
    private $table = 'users';
    private $loginUser;
    private $passwordUser;
    private $ageUser;
    private $number = 0;

    public function connectDB()
    {
        @$this->mysqli = new \mysqli($this->host,$this->user,$this->pass,$this->bd);

        if (mysqli_connect_errno()) {
            print 'Неизвестная ошибка на сайте.';
            exit();
        }
    }

    /**
     * @param $login
     * @param $password
     * @return bool
     *
     * Авторизация!
     */

    public function loginIn($login,$password)
    {
        /**
         * Изменить соль перед использованием!!! В двух местах!!!
         */
        $this->loginUser    = $this->mysqli->real_escape_string($login);
        $this->passwordUser = $this->mysqli->real_escape_string(crypt($password, 'InEnEfRvTlER'));
        $checkData = $this->mysqli->query
        (
            "SELECT `login`,`password` FROM `$this->table` 
             WHERE  `login`='".$this->loginUser."' 
             AND    `password`='".$this->passwordUser."' "

        );
        $realData = $checkData->fetch_array();
        if ($realData !== NULL) {
            return $realData;
        } else {
            print '<div style="font-size: 40px; color: mediumvioletred;">Неверные данные!</div> <br>';
            return false;
        }
    }

    /**
     * @param $login
     * @param $number
     *
     * Установка нового числа в бд пользователю.
     */

    public function setNumber($login,$number)
    {
        $this->loginUser  = $this->mysqli->real_escape_string($login);
        $this->mysqli->query
        (
            "UPDATE `users` SET `number`=\"$number\" 
             WHERE `login`=\"$login\" "

        );
        $this->mysqli->close();
    }

    /**
     * @param $login
     * @param $password
     *
     * Получение уникального числа в базе у пользователя!
     */

    public function prepareGetNumber($login,$password)
    {
        $this->loginUser    = $this->mysqli->real_escape_string($login);
        $this->passwordUser = $this->mysqli->real_escape_string($password);
        $result = Users::sendGetNumber();
        return $result;

    }

    private function sendGetNumber()
    {
        $checkData = $this->mysqli->query
        (
            "SELECT `number` FROM `$this->table` 
             WHERE  `login`='".$this->loginUser."' 
             AND    `password`='".$this->passwordUser."' "

        );
        if ($checkData !== false) {
            $realData = $checkData->fetch_array();
            return (int)$realData['number'];
        } else {
            print 'Произошла неизвестная ошибка, пожалуйста авторизуйтесь!';
            exit();
        }

    }


    /**
     * @param $log
     * @return mixed
     *
     * Запросить пароль, проверка подлинности куки!
     */

    public function queryPassword($log)
    {
        $this->loginUser = $this->mysqli->real_escape_string($log);
        $checkPass = $this->mysqli->query
        (
          "SELECT `password` FROM `$this->table` WHERE `login`='".$this->loginUser."' "
        );
        $realPass = $checkPass->fetch_array();
        $this->mysqli->close();
        return $realPass;
    }

    /**
     * @param $login
     * @return bool
     *
     * Проверить логин перед регистрацией
     */

    public function refLogin($login)
    {
        $this->loginUser    = $this->mysqli->real_escape_string($login);
        $checkLogin = $this->mysqli->query
        (
            "SELECT `login` FROM `$this->table` WHERE `login`='".$this->loginUser."' "
        );
        $checkLogin = $checkLogin->fetch_array();
        if (!empty($checkLogin['login'])) {
            $this->mysqli->close();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $pass
     * @param $age
     *
     * Регистрация пользователей в базе данных!
     */

    public function getDataRegistration($pass,$age)
    {
        /**
         * Изменить соль перед использованием!!! В двух местах!!!
         */
        $this->passwordUser = crypt($this->pass, 'InEnEfRvTlER');
        $this->ageUser      = $age;
        Users::prepareDataRegistration();
    }

    private function prepareDataRegistration()
    {
        $this->passwordUser = $this->mysqli->real_escape_string($this->passwordUser);
        $this->ageUser      = $this->mysqli->real_escape_string($this->ageUser);
        $this->number       = $this->mysqli->real_escape_string($this->number);
        Users::userRegistration();
    }

    private function userRegistration()
    {
        $this->mysqli->query
        (
            "INSERT into `$this->table` 
        (
        login,
        password,
        data,
        number
        ) 
        VALUES 
        (
        \"$this->loginUser\",
        \"$this->passwordUser\",
        \"$this->ageUser\",
        \"$this->number\"
        )"
        );
        $this->mysqli->close();
    }

    public function dataUser()
    {
        $date = [
            'login'    => $this->loginUser,
            'password' => $this->passwordUser
        ];
        return $date;
    }
}