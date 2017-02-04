<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 30.01.17
 * Time: 16:24
 */
class Questions
{

    /*Клиентская часть*/
    /*Метод добавления вопроса*/
    public static function addQuestion($region, $name, $email, $question, $typeFile = 0)
    {
        $db = DB::getConnection();
        $sql = "INSERT INTO questions (id_region, name, email, question, type_file) VALUES (?,?,?,?,?)";
        $result = $db->prepare($sql);
        $result->execute(array($region, $name, $email, $question, $typeFile));
        return $db->lastInsertId();
    }

    /*Метод добавления файла к вопросу*/
    public static function addFileById($id, $type)
    {
        $db = DB::getConnection();
        $sql = "UPDATE questions SET type_file=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($type, $id));
        return true;
    }
    /*Админ часть*/
    /*Вовращает массив всех вопросов по id региона*/
    public static function getList($region)
    {
        $questions = array();
        $db = DB::getConnection();
        if ($region == 51) {
            $sql = "SELECT * FROM questions " .
                "ORDER BY status, dateTime DESC";
            $result = $db->query($sql);
        } else {
            $sql = "SELECT * FROM questions where id_region=? " .
                "ORDER BY status, dateTime DESC";
            $result = $db->prepare($sql);
            $result->execute(array($region));
        }
        $i = 0;
        while ($row = $result->fetch()) {
            $questions[$i]['id'] = $row['id'];
            $questions[$i]['name'] = $row['name'];
            $questions[$i]['question'] = $row['question'];
            $questions[$i]['dateTime'] = $row['dateTime'];
            $questions[$i]['status'] = $row['status'];
            $questions[$i]['type_file'] = $row['type_file'];
            $i++;
        }
        return $questions;
    }

    /*Возвращает количество вопросов по id региона*/
    public static function countByRegion($region)
    {
        $db = DB::getConnection();
        $sql = "SELECT COUNT(*) FROM questions WHERE id_region=?";
        $result = $db->prepare($sql);
        $result->execute(array($region));
        return $result->fetchColumn();
    }

    /*Возвращает количество непрочитанных сообщений по id региона*/
    public static function countUnread($region)
    {
        $db = DB::getConnection();
        $sql = "SELECT COUNT(*) FROM questions WHERE id_region=? AND status=0";
        $result = $db->prepare($sql);
        $result->execute(array($region));
        return $result->fetchColumn();
    }

    /*Вовращает список вопросов по номеру страницы и id региона*/
    public static function getListByPage($page = 1, $region = 0)
    {
        $questions = array();
        $db = DB::getConnection();
        $countQuestionOnPage = 5; //число вопросов на одной странице
        $countQuestion = self::countByRegion($region);
        $totalPage = intval(($countQuestion - 1) / $countQuestionOnPage) + 1;
        if (empty($page) or $page < 0) $page = 1;
        if ($page > $totalPage) $page = $totalPage;
        $startQuestion = $page * $countQuestionOnPage - $countQuestionOnPage;
        if ($region == 51) {
            $sql = "SELECT id, name, question, dateTime, status FROM questions " .
                "ORDER BY status, dateTime DESC LIMIT ?,? ";
            $result = $db->prepare($sql);
            $result->bindValue(1, $startQuestion, PDO::PARAM_INT);
            $result->bindValue(2, $countQuestionOnPage, PDO::PARAM_INT);
            $result->execute();
        } else {
            $sql = "SELECT id, name, question, dateTime, status FROM questions WHERE id_region=? " .
                "ORDER BY status, dateTime DESC LIMIT ?,? ";
            $result = $db->prepare($sql);
            $result->bindValue(1, $region, PDO::PARAM_STR);
            $result->bindValue(2, $startQuestion, PDO::PARAM_INT);
            $result->bindValue(3, $countQuestionOnPage, PDO::PARAM_INT);
            $result->execute();
        }
        $i = 0;
        while ($row = $result->fetch()) {
            $questions[$i]['id'] = $row['id'];
            $questions[$i]['name'] = $row['name'];
            $questions[$i]['question'] = $row['question'];
            $questions[$i]['dateTime'] = $row['dateTime'];
            $questions[$i]['status'] = $row['status'];
            $i++;
        }

        return $questions;

    }

    /*Возвращает массив вопроса по id*/
    public static function getQuestion($id)
    {
        $question = array();
        $db = DB::getConnection();
        $sql = "SELECT * FROM questions where id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /*Метод ответа на вопрос*/
    public static function answer($id, $answer, $idUser)
    {
        $db = DB::getConnection();
        $sql = "UPDATE questions SET answer=?, id_user_answer=?, status=1 WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($answer, $idUser, $id));
        return true;
    }

    /*Метод отметки о прочтении вопроса*/
    public static function markAnswered($id, $idUser)
    {
        $db = DB::getConnection();
        $sql = "UPDATE questions SET id_user_answer=?, status=1 WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($idUser, $id));
        return true;
    }

    /*Метод отметки о непрочтении*/
    public static function markUnAnswered($id, $idUser)
    {
        $db = DB::getConnection();
        $sql = "UPDATE questions SET id_user_answer=?, status=0 WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($idUser, $id));
        return true;
    }

    /*Метод удаления вопроса*/
    public static function delete($id)
    {
        $db = DB::getConnection();
        $sql = "DELETE FROM questions WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        return true;
    }
}