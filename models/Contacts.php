<?php

class Contacts
{
    public static function recordQuestion($name, $email, $question)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO orchid.question(name,email,question) VALUES(?,?,?)";
        $result = $db->prepare($sql);
        $result->execute(array($name, $email, $question));
    }
}