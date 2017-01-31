<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 30.01.17
 * Time: 16:24
 */
class Questions
{
    const COUNT_PAGE = 5;

    public static function addQuestion($region, $name, $email, $question, $typeFile = 0)
    {
        $db = DB::getConnection();
        $sql = "INSERT INTO questions (id_region, name, email, question, type_file) VALUES (?,?,?,?,?)";
        $result = $db->prepare($sql);
        $result->execute(array($region, $name, $email, $question, $typeFile));
        return $db->lastInsertId();
    }

    public static function addFileById($id, $type)
    {
        $db = DB::getConnection();
        $sql = "UPDATE questions SET type_file=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($type, $id));
        return true;
    }

    public static function getList($region)
    {


        $questions = array();
        $db = DB::getConnection();
        if ($region == 0) {
            $sql = "SELECT name, question, dateTime,status FROM questions " .
                "ORDER BY status, dateTime DESC";
            $result = $db->query($sql);
        } else {
            $sql = "SELECT name, question, dateTime,status FROM questions where id_region=? " .
                "ORDER BY status, dateTime DESC";
            $result = $db->prepare($sql);
            $result->execute(array($region));
        }

        $i = 0;

        while ($row = $result->fetch()) {
            $questions[$i]['name'] = $row['name'];
            $questions[$i]['question'] = $row['question'];
            $questions[$i]['dateTime'] = $row['dateTime'];
            $questions[$i]['status'] = $row['status'];
            $i++;
        }

        return $questions;
    }

    public static function getListByPage($page = 1)
    {
        $questions=array();
        $db = DB::getConnection();
        $countQuestionOnPage = 3; //число вопросов на одной странице
        //Общее число вопросов
        $sql = "SELECT COUNT(*) FROM questions";
        $result = $db->query($sql);
        $countQuestion = $result->fetchColumn();
        //Общее число страниц
        $totalPage = intval(($countQuestion - 1) / $countQuestionOnPage) + 1;
        //стартовая страница; ПОПРОБОВАТЬ ПОТОМ УБРАТЬ
        
        // Если значение $page меньше единицы или отрицательно
        // переходим на первую страницу
        // А если слишком большое, то переходим на последнюю
        if (empty($page) or $page < 0) $page = 1;
        if ($page > $totalPage) $page = $totalPage;
        // Вычисляем начиная к какого номера
        // следует выводить вопросы
        $startQuestion = $page * $countQuestionOnPage - $countQuestionOnPage;
        $sql = "SELECT name, question, dateTime, status FROM questions LIMIT ?,?";
        $result = $db->prepare($sql);
        $result->bindValue(1, $startQuestion, PDO::PARAM_INT);
        $result->bindValue(2, $countQuestionOnPage, PDO::PARAM_INT);
        $result->execute();
        $i = 0;
        while ($row = $result->fetch()) {
            $questions[$i]['name'] = $row['name'];
            $questions[$i]['question'] = $row['question'];
            $questions[$i]['dateTime'] = $row['dateTime'];
            $questions[$i]['status'] = $row['status'];
            $i++;
        }
        return $questions;

    }
}