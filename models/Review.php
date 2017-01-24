<?php


class Review
{

    const SHOW_BY_DEFAULT = 4;

    public static function getBestListReviews()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT id, text, name, time, best, status '
            . 'FROM orchid.review WHERE best = 1 AND status = 1');

        $i = 0;
        $reviewBestList = array();
        while ($row = $result->fetch()) {
            $reviewBestList[$i]['id'] = $row['id'];
            $reviewBestList[$i]['text'] = $row['text'];
            $reviewBestList[$i]['name'] = $row['name'];
            $reviewBestList[$i]['time'] = $row['time'];
            $reviewBestList[$i]['best'] = $row['best'];
            $reviewBestList[$i]['status'] = $row['status'];
            $i++;
        }
        return $reviewBestList;
    }

    public static function getActiveListReviews($page = 1)
    {
        $limit = Review::SHOW_BY_DEFAULT;
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT id, text, name, time, status FROM orchid.review WHERE '
            . 'status = 1 LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        $result->execute();

        $i = 0;
        $reviewList = array();
        while ($row = $result->fetch()) {
            $reviewList[$i]['id'] = $row['id'];
            $reviewList[$i]['text'] = $row['text'];
            $reviewList[$i]['name'] = $row['name'];
            $reviewList[$i]['time'] = $row['time'];
            $reviewList[$i]['status'] = $row['status'];
            $i++;
        }
        return $reviewList;
    }

    public static function modelTime($time, $months)
    {
        $month = array(
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря');

        $time = substr($time, 0, 10);
        $stringTime = explode("-", $time, 3);
        if ($months)
            $time = (int)$stringTime[2] . ' ' . $month[$stringTime[1]] . ' ' . $stringTime[0];
        else
            $time = (int)$stringTime[2] . '.' . (int)$stringTime[1] . '.' . $stringTime[0];
        return $time;
    }


    public static function getTotalStocks()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM orchid.review';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];
    }

    public static function recordReview($name, $email, $review)
    {
        $db = Db::getConnection();
        $sql = "INSERT INTO orchid.review(name,email,text) VALUES(?,?,?)";
        $result = $db->prepare($sql);
        $result->execute(array($name, $email, $review));
    }
}
