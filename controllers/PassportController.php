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
        require_once(ROOT . '/views/passport/formGeneralAdd.php');
        return true;
    }

    /*Метод содания технического паспорта*/
    public function methodNew()
    {

        echo Passports::newPassport($_POST['type'], $_POST['name'], $_POST['region'], $_POST['city'], $_POST['street'],
            $_POST['num_home'], $_POST['letter'], $_POST['inv_num'],
            $_POST['kad_num'], date("Y-m-d", strtotime($_POST['inv_date'])), $_POST['idUser']);

        return true;
    }


    /*Меню редактировния паспортов*/
    public function methodEditPassportMenu($id)
    {
        $title = "Редактирование технического паспорта: $id";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        if ($_SESSION['access'] < 2)
            header("Location:errorAccess");
        $info = Passports::getMainInfo($id);
        
        require_once(ROOT . '/views/passport/editMenu.php');
        return true;

    }
    /*Редактирование основной информации паспорта*/
    public function methodEditGeneral($id)
    {
        $title = "Редактирование основной информмации технического паспорта: $id";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        if ($_SESSION['access'] < 2)
            header("Location:errorAccess");
        $types = Passports::GetTypeObjectList();
        $generalInfo=Passports::getGeneralInfo($id);
        require_once(ROOT . '/views/passport/formGeneralEdit.php');
        return true;

    }
    /*Сохранение изменений основной информации паспорта*/
    public function methodEditGeneralSave($id)
    {
        print_r($_POST);
        Passports::editGeneralInfo($id,$_POST['type'], $_POST['name'], $_POST['region'], $_POST['city'], $_POST['street'],
            $_POST['num_home'], $_POST['letter'], $_POST['inv_num'],
            $_POST['kad_num'], date("Y-m-d", strtotime($_POST['inv_date'])), $_POST['idUser']);
        return true;
    }
}