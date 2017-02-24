<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 07.02.17
 * Time: 16:24
 */
class Passports
{
    /*Вовзращает массив типов элементов объектов*/
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

    /*Метод создания нового паспорта*/
    public static function newPassport($type_object, $name, $region,
                                       $city, $street, $num_home, $letter,
                                       $inv_num, $kad_num, $inv_date, $userId)
    {
        $db = DB::getConnection();
        $sql = " INSERT INTO passports(type_object,name_object,region,city,street,num_home,letter,inv_num,kad_num,inv_date,id_user_add)" .
            " VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $result = $db->prepare($sql);
        $result->execute(array($type_object, $name, $region, $city,
            $street, $num_home, $letter, $inv_num, $kad_num, $inv_date, $userId));
        return $db->lastInsertId();
    }

    /*Возвращает основную информацию по id паспорта*/
    public static function getMainInfo($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT name_object,city,street,num_home FROM passports WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /*Возвращает основную информацию по id паспорта*/
    public static function getGeneralInfo($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT type_object,name_object,city,street,num_home,letter, " .
            "inv_num, kad_num,inv_date FROM passports WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /*Сохранение изменений основной информации*/
    public static function editGeneralInfo($id, $type_object, $name, $region,
                                           $city, $street, $num_home, $letter,
                                           $inv_num, $kad_num, $inv_date, $userId)
    {
        $db = DB::getConnection();
        $sql = "UPDATE passports SET type_object=?,name_object=?,region=?, city=?, street=?, num_home=?," .
            "letter=?, inv_num=?,kad_num=?, inv_date=?, id_user_edit=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($type_object, $name, $region, $city,
            $street, $num_home, $letter, $inv_num, $kad_num, $inv_date, $userId, $id));
        return true;

    }

    /*Получение статуса заполненности разделов паспорта по id*/
    public static function getStatusSection($id)
    {
        $db = DB::getConnection();
        $sql = "SELECT fullComposition FROM passports WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }
    
    /*Получение списка видов назначения объектов*/
    public static function GetUseObjectList()
    {
        $uses = array();
        $db = DB::getConnection();
        $sql = "SELECT * FROM use_object";
        $result = $db->query($sql);
        $i = 0;
        while ($row = $result->fetch()) {
            $uses[$i]['id'] = $row['id'];
            $uses[$i]['name'] = $row['name'];
            $i++;
        }
        return $uses;
    }
}