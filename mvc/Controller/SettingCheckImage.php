<?php
/**
 * Created by PhpStorm.
 * User: Programming_2
 * Date: 26.09.2017
 * Time: 13:02
 */

namespace liw\mvc\Controller;


abstract class SettingCheckImage
{
    protected $uploadDir;
    protected $fileType;
    protected $fileSize;
    protected $maxWidth;
    protected $maxHeight;
    protected $checkSize;

    public function __construct($dir, $size, $maxWidth, $maxHeight)
    {
        $this->uploadDir = $dir;
        $this->fileSize  = $size;
        $this->maxWidth  = $maxWidth;
        $this->maxHeight = $maxHeight;
    }

    public function checkedFile()
    {
        $this->fileType = mime_content_type($_FILES["loadFile"]["tmp_name"]);
    }
}