<?php

namespace liw\mvc\Controller\Profile\ProfileFunction\Privilege;


use liw\mvc\Model\Profile\ProfileUser;
use liw\mvc\Model\Profile\Users;

class ChangePrivilege
{
    public function checkPrivilege($nickname, $privilege, $currentPrivilege)
    {
        if ($currentPrivilege != 'admin') {
            die("Вы не админ!");
        }

        $this->setPrivilege($nickname, $privilege);
    }

    private function setPrivilege($nickname, $privilege)
    {
        $users       = new Users();
        $profileUser = new ProfileUser();

        $users->connectBD();
        $profileUser->connectBD();

        $users->updatePrivilege($nickname,$privilege);
        $profileUser->updatePrivilege($nickname,$privilege);
    }
}