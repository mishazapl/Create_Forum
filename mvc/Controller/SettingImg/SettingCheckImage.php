<?php
/**
 * Created by PhpStorm.
 * User: Programming_2
 * Date: 26.09.2017
 * Time: 13:02
 */

namespace liw\mvc\Controller\SettingImg;


abstract class SettingCheckImage
{
    protected $uploadDir;
    protected $fileType;
    protected $fileSize;
    protected $maxWidth;
    protected $maxHeight;
    protected $checkSize;

    /**
     * CheckPngJpg constructor.
     * @param $dir
     * @param $size
     * @param $maxWidth
     * @param $maxHeight
     *
     * Устанавливаем наши значения.
     */

    public function __construct($dir, $size, $maxWidth, $maxHeight)
    {
        $this->uploadDir = $dir;
        $this->fileSize  = $size;
        $this->maxWidth  = $maxWidth;
        $this->maxHeight = $maxHeight;
    }

    protected function checkedFile()
    {
        $this->checkSize = (getimagesize($_FILES["loadFile"]["tmp_name"]));
        $this->fileType = mime_content_type($_FILES["loadFile"]["tmp_name"]);
        /**
         * Пример реализации в дочернем классе.
         * parent::checkedFile();
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
        return (string)$this->uploadDir . $_FILES["loadFile"]["name"];
        } else {
        print '<div style="font-size: 40px; color: mediumvioletred;">Файл не должен привышать размер 2мб!<br>
        Файл не должен привышать размер 1900px / 1200px</div>';
        return false;
        }
         */
    }
}