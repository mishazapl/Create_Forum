<?php

namespace liw\mvc\Controller;

use liw\mvc\Model\ProfileUser;

class Profile
{
    private $login;
    private $Age;
    private $linkPhoto;

    public function getDataUser($autologin)
    {
        $getData = new ProfileUser();
        $getData->connectBD();
        $result = $getData->getUserData($autologin);
        return $result;
    }

    /**
     * Меняем имя загруженного файла в зависимости от его типа.
     */

    public function checkFormatPhoto()
    {
        $fileCheck = new CheckPngJpg('imgProfile/', 2097152, 1200,900);

        if (mime_content_type($_FILES["loadFile"]["tmp_name"]) == 'image/jpeg') {
            $_FILES["loadFile"]["name"] = bin2hex(random_bytes(10)) .'.jpeg';
            $fileDir = $fileCheck->checkedFile();
            if ($fileDir !== false) {
                $this->setPhoto($fileDir);
            }
        } elseif (mime_content_type($_FILES["loadFile"]["tmp_name"]) == 'image/png') {
            $_FILES["loadFile"]["name"] = bin2hex(random_bytes(10)) .'.png';
            $fileDir = $fileCheck->checkedFile();
            if ($fileDir !== false) {
                $this->setPhoto($fileDir);
            }
        } else {
            print '<div style="font-size: 40px; color: mediumvioletred;">Файл должен быть либо PNG, либо JPEG!<br>
                   И не должен привышать размер 2мб!</div>';
        }
    }

    private function setPhoto($fileDir)
    {
        $ProfileUser = new ProfileUser();
        $ProfileUser->connectBD();
        $ProfileUser->loadPhotos($fileDir);

    }

    public function exitUser($login)
    {
        setcookie(
            "login",
            "$login",
            time()-5000
        );
        print "<div style='font-size: 30px; color: aquamarine; text-align: center;'>Досвидание!</div>";
        print "<br><div style='text-align: center;'><a href='index.php' style='font-size: 20px; color: chartreuse;'>Обновить страницу</a></div>";
        exit();
    }

}