<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 07.02.17
 * Time: 13:22
 */

class ErrorController{
    public function methodAccess()
    {
        $title = "Отказано в доступе";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        require_once(ROOT . '/views/admin/errorAccess.php');
        return true;
    }
}