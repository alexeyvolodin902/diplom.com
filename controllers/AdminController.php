<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 27.01.17
 * Time: 14:31
 */
Class AdminController
{
    /*В зависимости от уровня доступа переадреусует на необходимые страницы*/
    public function methodIndex()
    {
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $access = $_SESSION['access'];
        if ($access == 1) {
            header("Location:questionAdmin/1");
        }
        if ($access == 2) {
            header("Location:admin2");
        }

        return true;

    }

    /*Метод авторизации пользователей*/
    public function methodAuth()
    {
        $title = "Форма входа";
        session_start();
        session_destroy();
        $error = false; //используется для вывода сообщения о неверном логине и пароле
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $access = Users::checkUser($login, $password);
            if ($access > 0) {
                session_start();
                $_SESSION['access'] = $access;
                $_SESSION['login'] = $login;
                header("Location:/admin");
            } else $error = true;
        }
        require_once(ROOT . '/views/admin/auth.php');
        return true;

    }

    /*Метод меню для пользователя с уровнем 2*/
    public function methodLevel2()
    {
        session_start();
        $title = "Панель управления";
        if (!isset($_SESSION['access']))
            header("Location:auth");
        
        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        if ($_SESSION['access'] < 2)
            require_once(ROOT . '/views/admin/errorAccess.php');
        else
            require_once(ROOT . '/views/admin/level2.php');
        return true;
    }


}
