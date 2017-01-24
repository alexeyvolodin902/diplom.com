<?php

/**
 * Created by PhpStorm.
 * User: Fandu
 * Date: 01.11.2016
 * Time: 21:39
 */
class Service
{

    //return List categories
    public static function getServiciesList()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT * FROM services');

        $i = 0;
        $serviceList = array();
        while ($row = $result->fetch()) {
            $serviceList[$i]['id_services'] = $row['id_services'];
            $serviceList[$i]['name'] = $row['name'];
            $i++;
        }
        return $serviceList;
    }

    public static function getServiciesListItems()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT * FROM service');

        $i = 0;
        $serviceListItem = array();
        while ($row = $result->fetch()) {
            $serviceListItem[$i]['id_service'] = $row['id_service'];
            $serviceListItem[$i]['id_services'] = $row['id_services'];
            $serviceListItem[$i]['name'] = $row['name'];
            $serviceListItem[$i]['price'] = $row['price'];
            $i++;
        }
        return $serviceListItem;
    }
    
}