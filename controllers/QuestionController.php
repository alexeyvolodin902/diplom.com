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
        require_once(ROOT . '/views/client/question.php');
        return true;
    }
    
    public function actionAddQuestion()
    {
        return "jr";
    }
}