<?php

class Albums
{

    public static function getAlbumsList()
    {
        $albumsList = array();
        $db = Db::getConnection();

        $result = $db->query("SELECT id, name, coverUrl  FROM albums");
        $i = 0;
        while ($row = $result->fetch()) {
            $albumsList[$i]['id'] = $row['id'];
            $albumsList[$i]['name'] = $row['name'];
            $albumsList[$i]['coverUrl'] = $row['coverUrl'];
            $i++;
        }
        return $albumsList;
    }

    public static function getNameAlbum($idAlbum)
    {

        $db = Db::getConnection();
        //$result = $db->query("SELECT name FROM albums WHERE id=$idAlbum");

        $result = $db->prepare("SELECT name FROM albums WHERE id = ?");
        $result->execute(array($idAlbum));
        $albumName = $result->fetch();
        return $albumName['name'];


    }

    public static function getPhotoByAlbum($idAlbum)
    {
        $photoList = array();
        $db = Db::getConnection();
        $result = $db->prepare("SELECT url FROM photo WHERE idAlbum = ?");
        $result->execute(array($idAlbum));
        $i = 0;
        while($row = $result->fetch()){
            $photoList[$i]['url'] = $row['url'];
            $i++;
        }
        return $photoList;
    }
    
}

