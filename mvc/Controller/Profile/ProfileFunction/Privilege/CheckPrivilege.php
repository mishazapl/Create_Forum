<?php

namespace liw\mvc\Controller\Profile\ProfileFunction\Privilege;

use liw\mvc\Model\Profile\Users;

class CheckPrivilege
{
    /**
     * @param $cookie
     * Проверяем привелегии пользователя.
     */
    public static function getPermission($cookie)
    {
        $users = new Users();
        $users->connectBD();
        $privilege = $users->getPrivilege($cookie);
        $result = $privilege['privilege'];
        unset($privilege);
        return $result;
    }
}