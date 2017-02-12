<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 07.02.17
 * Time: 13:12
 */
class PassportController
{
    /*Главное меню паспортов*/
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

    /*Меню добавления паспортов*/
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
    /*Форма общих сведений*/
    public function methodFormGeneral()
    {
        $title = "Общие сведения";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        if ($_SESSION['access'] < 2)
            header("Location:errorAccess");

        $types = Passports::GetTypeObjectList();
        require_once(ROOT . '/views/passport/formGeneral.php');
        return true;
    }
    public function methodNew()
    {
        print_r($_POST);
        return true;
    }
}