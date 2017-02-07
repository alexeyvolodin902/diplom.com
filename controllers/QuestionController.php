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

        //удаление старых вопросов
        $allQuestions = Questions::getList($idRegion);
        $currentDate = new DateTime();
        foreach ($allQuestions as $oneQuestion) {
            $questionDateTime = new DateTime($oneQuestion['dateTime']);
            $interval = $currentDate->diff($questionDateTime);
            if ($interval->format("%a") > 365) {
                Questions::delete($oneQuestion['id']);
                if (!empty($oneQuestion['type_file'])) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/media/questionFiles/" . $oneQuestion['id'] . "." . $oneQuestion['type_file']);
                }

            }
        }
        //Конец удаления старых вопросов

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
        if (!empty($question['id_user_answer'])) {
            $userAnswer = Users::getNameById($question['id_user_answer']);
        }
        if ($question['id_region'] != $idRegion)
            header("Location:errorAccess");

        require_once(ROOT . '/views/admin/questionAnswer.php');


        return true;
    }

    /*Метод отправления ответа на вопрос*/
    public function methodAddAnswer()
    {
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        if (isset($_POST['id'])
            && isset($_POST['answer'])
            && isset($_POST['idUser'])
            && isset($_POST['email'])
        ) {

            Questions::answer($_POST['id'], $_POST['answer'], $_POST['idUser']);

            /*отправка email*/

            $to = $_POST['email'];
            $subject = 'НижТехИнвентаризация. Ответ на вопрос.';
            $body = $_POST['answer'];
            $from = 'From: From Address <from.admin@gpnti.ru>' . "\r\n";
            $option = "-fvolodinyalexei@yandex.ru";
            mail($to, "=?utf-8?B?" . base64_encode($subject) . "?=", $body, $from, $option);
        }
        return true;
    }

    /*Метод пометки вопроса отвеченным*/
    public function methodMarkAnswered()
    {
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        if (isset($_POST['id'])
            && isset($_POST['idUser'])
        ) {
            Questions::markAnswered($_POST['id'], $_POST['idUser']);
        }
        return true;
    }

    /*Метод пометки вопроса неотвеченным*/
    public function methodMarkUnAnswered()
    {
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        if (isset($_POST['id'])
            && isset($_POST['idUser'])
        ) {
            Questions::markUnAnswered($_POST['id'], $_POST['idUser']);
        }
        return true;
    }

    /*Метод удаления вопроса*/
    public function methodDelete()
    {
        session_start();
        if (!isset($_SESSION['access']))
            header("Location:auth");
        if (isset($_POST['id'])) {
            $question = Questions::getQuestion($_POST['id']);
            Questions::delete($_POST['id']);
            if (!empty($question['type_file'])) {
                unlink($_SERVER['DOCUMENT_ROOT'] . "/media/questionFiles/" . $question['id'] . "." . $question['type_file']);
            }


        }
        return true;
    }


}