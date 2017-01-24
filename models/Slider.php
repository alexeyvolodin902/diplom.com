<?php

/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 01.11.16
 * Time: 16:02
 */
class Slider
{
    //Возвращает массив с данными мастеров из бд
    public static function getResourcesSlider()
    {
        $sliderList = array();
        $db = Db::getConnection();
        $result = $db->query("SELECT id,header, content ,url_image FROM indexSlider");
        $i = 0;
        while ($row = $result->fetch()) {
            $sliderList[$i]['id'] = $row['id'];
            $sliderList[$i]['header'] = $row['header'];
            $sliderList[$i]['content'] = $row['content'];
            $sliderList[$i]['url_image'] = $row['url_image'];
            $i++;
        }
        return array_reverse($sliderList);
    }

    public static function deleteSlideById($id)
    {
        $db = Db::getConnection();
        $sql = "SELECT url_image FROM indexSlider WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        $row = $result->fetch();
        $sql = "DELETE FROM indexSlider WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        return $row['url_image'];
    }

    public static function addSlide($head, $desc)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO indexSlider(header, content) VALUES (?,?) ";
        $result = $db->prepare($sql);
        $result->execute(array($head, $desc));
        return $db->lastInsertId();
    }

    public static function addImageToSlide($id, $url_image)
    {
        $db = Db::getConnection();
        $sql = "UPDATE indexSlider SET url_image=? WHERE id=?";
        $result = $db->prepare($sql);
        return $result->execute(array($url_image, $id));
    }

    public static function getInfoSlide($id)
    {
        $db = Db::getConnection();
        $sql = "SELECT header, content FROM indexSlider WHERE id=?";
        $result = $db->prepare($sql);
        $result->execute(array($id));
        $row = $result->fetch();
        $slide['header'] = $row['header'];
        $slide['content'] = $row['content'];
        $slide['id'] = $id;


        return $slide;
    }

    public static function saveSlide($id, $head, $desc)
    {
        $db = Db::getConnection();
        $sql = "UPDATE indexSlider SET header=?,content=? WHERE id=?";
        $result = $db->prepare($sql);
        return $result->execute(array($head, $desc, $id));
    }

}