<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 07.02.17
 * Time: 13:12
 */
class PassportController
{

    public function methodIndex()
    {
        $title = "Технические паспорта";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        if ($_SESSION['access'] < 2)
            header("Location:errorAccess");
        require_once(ROOT . '/views/passport/index.php');
        return true;

    }
    public function methodAddMenu()
    {
        $title = "Добавление нового технического паспорта";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        if ($_SESSION['access'] < 2)
            header("Location:errorAccess");
        require_once(ROOT . '/views/passport/addMenu.php');
        return true;

    }
}