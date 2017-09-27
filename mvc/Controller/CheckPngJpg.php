<?php

namespace liw\mvc\Controller;


class CheckPngJpg extends SettingCheckImage
{
    private $uploadDir;
    private $fileType;
    private $fileSize;
    private $maxWidth;
    private $maxHeight;
    private $checkSize;

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
        $this->fileSize = $size;
        $this->maxWidth = $maxWidth;
        $this->maxHeight = $maxHeight;
    }

    /**
     * @return bool
     *
     * Проверяем файл на соотвествие параметрам.
     */

    public function checkedFile()
    {
        $this->checkSize = (getimagesize($_FILES["loadFile"]["tmp_name"]));
        $this->fileType = mime_content_type($_FILES["loadFile"]["tmp_name"]);
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
        }
}