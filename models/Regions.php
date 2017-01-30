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
    public static function getAll()
    {
        $regions=array();
        $db= DB::getConnection();
        $sql = "SELECT * FROM regions";
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch()) {
            $regions[$i]['id'] = $row['id'];
            $regions[$i]['name'] = $row['name'];           
            $i++;
        }
        return $regions;

        
    }
}