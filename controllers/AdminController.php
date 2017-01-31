<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 27.01.17
 * Time: 14:31
 */
Class AdminController
{
    
    public function methodIndex()
    {
        $title = "Панель управления";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $access = $_SESSION['access'];        
        if ($access == 1) {
            header("Location:questionAdmin/1");
        }

        return true;

    }

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


}
