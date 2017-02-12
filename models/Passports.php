<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 07.02.17
 * Time: 16:24
 */
class Passports
{
    public static function GetTypeObjectList()
    {
        $types = array();
        $db = DB::getConnection();
        $sql = "SELECT * FROM type_object";
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch()) {
            $types[$i]['id'] = $row['id'];
            $types[$i]['type'] = $row['type'];
            $i++;
        }
        return $types;
    }

    public static function newPassport($type_object,
                                       $name_object,
                                       $area,
                                       $region,
                                       $city,
                                       $street,
                                       $num_home,
                                       $letter,
                                       $inv_num,
                                       $kad_num,
                                       $inv_date)
    {

    }
}