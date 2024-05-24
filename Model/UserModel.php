<?php
    require_once ROOT_PATH . "/Model/DataBase.php";

    class UserModel extends DataBase
    {
        public function getUsers($limit) : array
        {
            return $this->select($limit);
        }
    }
?>
