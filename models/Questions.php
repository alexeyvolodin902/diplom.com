<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 30.01.17
 * Time: 16:24
 */
class Questions
{
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
        $sql = "SELECT name, question, dateTime,status FROM questions where id_region=? ORDER BY status ,dateTime DESC";
        $result = $db->prepare($sql);
        $result->execute(array($region));
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