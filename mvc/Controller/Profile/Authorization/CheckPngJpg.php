<?php

namespace liw\mvc\Controller\Profile\Authorization;

use liw\mvc\Controller\SettingImg\SettingCheckImage;

class CheckPngJpg extends SettingCheckImage
{

    /**
     * @return bool
     *
     * Проверяем файл на соотвествие параметрам.
     */

    public function checkedFile()
    {
        parent::checkedFile();
        if (
            $_FILES["loadFile"]["size"] > 0
            &&
            $_FILES["loadFile"]["size"] < $this->fileSize
            &&
            $this->checkSize[0] < 1900
            &&
            $this->checkSize[1] < 1200
            &&
            $this->fileType == 'image/jpeg'
            ||
            $this->fileType == 'image/png'
        ) {
            var_dump($this->fileType);
            return $this->uploadDir . $_FILES["loadFile"]["name"];
        } else {
            print '<div style="font-size: 40px; color: mediumvioletred;">Файл не должен привышать размер 2мб!<br>
                       Файл не должен привышать размер 1900px / 1200px</div>';
            return false;
        }
    }
}