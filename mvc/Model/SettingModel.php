<?php

namespace liw\mvc\Model;

/**
 * Class SettingModel
 * @package liw\mvc\Model
 *
 * Настройки для всех моделей, обязательно наследовать!
 */

abstract class SettingModel
{
    private $host;
    private $user;
    private $pass;
    private $bd;
    private $mysqli;
    private $table;

    public function connectBD()
    {
        @$this->mysqli = new \mysqli($this->host,$this->user,$this->pass,$this->bd);

        if (mysqli_connect_errno()) {
            print 'Неизвестная ошибка на сайте.';
            exit();
        }
    }
}