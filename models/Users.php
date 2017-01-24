<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 02.12.16
 * Time: 21:22
 */
class Users
{

    public static function checkUsers($login, $password)
    {

        $db = Db::getConnection();
        $sql = "SELECT COUNT(*) FROM users WHERE login=? AND password=?";
        $result = $db->prepare($sql);
        $result->execute(array($login, $password));
        return($result->fetchColumn());
    }
}