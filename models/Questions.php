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
        $result->execute(array($region,$name,$email,$question,$typeFile));
        return $db->lastInsertId();
    }
    public static function addFileById($id, $type){
        $db = DB::getConnection();
        $sql = "UPDATE questions SET type_file=? WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($type,$id));
        return true;
    }
}