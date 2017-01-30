<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 28.01.17
 * Time: 19:24
 */
class QuestionController
{
    public function actionIndex()
    {
        $title = "Задать вопрос";
        $regions = Regions::getAll();
        require_once(ROOT . '/views/client/question.php');
        return true;
    }

    public function actionAddQuestion()
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
                Questions::addFileById($id,$exp);
            } 
            

        }
        return true;
    }
}