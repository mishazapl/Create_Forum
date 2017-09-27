<?php
namespace liw\mvc\Model;

class ProfileUser extends SettingModel
{
    private $host  = 'localhost';
    private $user  = 'root';
    private $pass  = '';
    private $bd    = 'user';
    private $mysqli;
    private $table = 'ProfileUser';
    private $loginUser;
    private $ageUser;
    private $linkPhoto;
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
     * @param $dir
     *
     * Загрузка фотографии профиля
     */

    public function loadPhotos($dir)
    {
        $this->autologin = $_COOKIE['login'];
        $this->linkPhoto = $dir;

        $checkQuery = $this->mysqli->query
        (
            "UPDATE `$this->table` SET `LinkPhoto`=\"$this->linkPhoto\"
             WHERE `AutoLogin`=\"$this->autologin\" "
        );

        if ($checkQuery === true) {
            move_uploaded_file($_FILES['loadFile']['tmp_name'], $this->linkPhoto);
            header('Location: http://localhost/web/index.php');
            $this->mysqli->close();
        } else {
            print 'Ошибка фото не загруженно!';
        }
    }

    /**
     * @param $autologin
     * @return mixed
     *
     * Получение данных профиля на странице пользователя.
     */

    public function getUserData($autologin)
    {
        $checkData = $this->mysqli->query
        (
            "SELECT `Login`,`Age`, `LinkPhoto`, `privilege` FROM `$this->table` 
             WHERE 
             `AutoLogin`=\"$autologin\""
        );
        $realData = $checkData->fetch_array();
        $this->mysqli->close();
        return $realData;
    }

    /**
     * @param $login
     * @param $age
     * @param $photo
     * @param $autologin
     *
     * Подготовка и установка данных в отдельную таблицу после регистрации.
     */

    public function prepareDataBeforeReg($login,$age, $photo,$autologin, $privilege)
    {
        $this->loginUser = $login;
        $this->ageUser = $age;
        $this->linkPhoto = $photo;
        $this->autologin = $autologin;
        $this->privilege = $privilege;

        $this->loginUser      = $this->mysqli->real_escape_string($this->loginUser);
        $this->ageUser        = $this->mysqli->real_escape_string($this->ageUser);
        $this->linkPhoto      = $this->mysqli->real_escape_string($this->linkPhoto);
        $this->autologin      = $this->mysqli->real_escape_string($this->autologin);
        $this->privilege      = $this->mysqli->real_escape_string($this->privilege);

        $this->installDataAfterRegistr();
    }

    private function installDataAfterRegistr()
    {
        $this->mysqli->query
        (
            "INSERT into `$this->table` 
        (
        Login,
        Age,
        LinkPhoto,
        AutoLogin,
        privilege
        ) 
        VALUES 
        (
        \"$this->loginUser\",
        \"$this->ageUser\",
        \"$this->linkPhoto\",
        \"$this->autologin\",
        \"$this->privilege\"
        )"
        );
        $this->mysqli->close();

        return true;
    }

    /**
     * @param $autologin
     * @return mixed
     *
     * Получение логина юзера для использование в новостях.
     */

    public function getLogin($autologin)
    {
        $this->autologin = $this->mysqli->real_escape_string($autologin);

        $checkPrivilege = $this->mysqli->query
        (
            "SELECT `login` FROM `$this->table` WHERE `autologin`='".$this->autologin."' "
        );
        $checkPrivilege = $checkPrivilege->fetch_array();
        $this->mysqli->close();
        return $checkPrivilege['login'];
    }
}