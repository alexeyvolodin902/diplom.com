<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 27.01.17
 * Time: 15:55
 */
class Users
{
    /*Проверяет наличие пользователя с заданным логином и паролем в БД*/
    public static function checkUser($login, $password)
    {
        $db = DB::getConnection();
        $sql = "SELECT access FROM users WHERE login=? AND password=?";
        $result = $db->prepare($sql);
        $result->execute(array($login, $password));
        return $result->fetchColumn();
    }

    /*Возвращает информацию о пользователе по логину*/
    public static function getUserInfo($login)
    {

        $db = DB::getConnection();
        $sql = "SELECT FIO, id_region, position FROM users WHERE login=?";
        $result = $db->prepare($sql);
        $result->execute(array($login));
        return $result->fetch(PDO::FETCH_ASSOC);
    }


}