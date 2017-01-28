<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 28.01.17
 * Time: 19:20
 */
class Regions
{
    public static function getNameById($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT name FROM regions WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        return $result->fetchColumn();
    }
}