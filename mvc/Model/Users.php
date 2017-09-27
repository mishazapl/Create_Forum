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
    private $autologin;
    private $privilege;

    public function connectBD()
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
        $this->autologin = bin2hex(random_bytes(100));

        $this->loginUser    = $this->mysqli->real_escape_string($login);
        $this->passwordUser = $this->mysqli->real_escape_string(crypt($password, 'InEnEfRvTlER'));
        $checkData = $this->mysqli->query
        (
            "SELECT `autologin` FROM `users` WHERE `login`=\"$login\"
             AND `password`=\"$this->passwordUser\" "

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
          "SELECT `autologin` FROM `$this->table` WHERE `autologin`='".$this->loginUser."' "
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
        $this->passwordUser = crypt($pass, 'InEnEfRvTlER');
        $this->ageUser      = $age;
        $this->prepareDataRegistration();
    }

    private function prepareDataRegistration()
    {
        $this->autologin = bin2hex(random_bytes(100));

        $this->loginUser    = $this->mysqli->real_escape_string($this->loginUser);
        $this->passwordUser = $this->mysqli->real_escape_string($this->passwordUser);
        $this->ageUser      = $this->mysqli->real_escape_string($this->ageUser);
        $this->autologin    = $this->mysqli->real_escape_string($this->autologin);
        $this->privilege    = $this->mysqli->real_escape_string('user');

        $this->userRegistration();
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
        autologin,
        privilege
        ) 
        VALUES 
        (
        \"$this->loginUser\",
        \"$this->passwordUser\",
        \"$this->ageUser\",
        \"$this->autologin\",
        \"$this->privilege\"
        )"
        );
        $this->mysqli->close();
        /**
         * Установка данных в таблицу для профиля.
         */
        $Profile = new ProfileUser();
        $Profile->connectBD();
        $checkInstall = $Profile->prepareDataBeforeReg
        (
            $this->loginUser,
            $this->ageUser,
            0,
            $this->autologin,
            $this->privilege
        );
        if ($checkInstall === true) {
            unset($Profile);
        }
    }

    public function dataUser()
    {
        $date = [
            'login'    => $this->autologin,
        ];
        return $date;
    }

    /**
     * @param $cookie
     * @return mixed
     *
     * Получение привелигий юзера из базы.
     */

    public function getPrivilege($cookie)
    {
        $checkPrivilege = $this->mysqli->query
        (
            "SELECT `privilege` FROM `$this->table` WHERE `autologin`='".$cookie."' "
        );
        $checkPrivilege = $checkPrivilege->fetch_array();
        $this->mysqli->close();
        return $checkPrivilege;
    }
}