<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 28.01.17
 * Time: 19:24
 */
class QuestionController
{
    /*Метод страницы вопросов клиентской части*/
    public function methodIndex()
    {

        $title = "Задать вопрос";
        $regions = Regions::getAll();
        require_once(ROOT . '/views/client/question.php');
        return true;
    }

    /*Метод добавления вопроса*/
    public function methodAddQuestion()
    {
        if (isset($_POST['region']) &&
            isset($_POST['name']) &&
            isset($_POST['email']) &&
            isset($_POST['question'])
        ) {

            $id = Questions::addQuestion($_POST['region'], $_POST['name'], $_POST['email'], $_POST['question']);
            if (isset($_FILES['addedFile'])) {
                $info = new SplFileInfo($_FILES['addedFile']['name']);
                $exp = $info->getExtension();
                $uploadFile = "media/questionFiles/" . $id . "." . $exp;
                move_uploaded_file($_FILES['addedFile']['tmp_name'], $uploadFile);
                Questions::addFileById($id, $exp);
            }
        }
        return true;
    }

    /*Метод страницы управления вопросами*/
    public function methodAdmin($page = 1)
    {
        $title = "Панель управления вопросами";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");

        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        $questions = Questions::getListByPage($page, $idRegion);
        $unreadCount = Questions::countUnread($idRegion);
        $countQuestion = Questions::countByRegion($idRegion);
        require_once(ROOT . '/views/admin/questionList.php');
        return true;
    }

    /*Метод страницы ответа на вопрос*/
    public function methodAnswer($id)
    {
        $title = "Страница ответа на вопрос";
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        $userInfo = Users::getUserInfoByLogin($_SESSION['login']);
        $idRegion = $userInfo['id_region'];
        $userRegion = Regions::getNameById($idRegion);
        $question = Questions::getQuestion($id);
        if(!empty($question['id_user_answer']))
        {
            $userAnswer = Users::getNameById($question['id_user_answer']);
        }
        if ($question['id_region'] != $idRegion)
            require_once(ROOT . '/views/admin/errorAccess.php');
        else
            require_once(ROOT . '/views/admin/questionAnswer.php');

        /*test*/


        /*$to = 'alexeyvoin902@gmail.com';
        $subject = 'ответ на вопрос!';
        $body = 'Приветики';
        $from = 'From: From Address <from.answer@gpnti.ru>' . "\r\n";
        $option = "-fvolodinyalexei@yandex.ru";
        //mail($to, "=?utf-8?B?".base64_encode($subject)."?=", $body, $from, $option);*/

        return true;
    }

}