<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 27.01.17
 * Time: 14:31
 */
Class AdminController
{


    public function actionIndex()
    {
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:/auth");
        $access = $_SESSION['access'];
        if ($access == 0)
            require_once(ROOT . '/views/admin/index.php');

        return true;

    }

    public function actionAuth()
    {

        $error = false;
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $access = Users::checkUser($login, $password);
            if ($access > 0) {
                session_start();
                $_SESSION['access'] = $access;
                header("Location:/admin");
            } else $error = true;
        }

        require_once(ROOT . '/views/admin/auth.php');
        return true;

    }

    public function actionExit()
    {

        session_start();
        session_destroy();
        $error= false;
        header("Location:/auth");
        return true;
    }


}
