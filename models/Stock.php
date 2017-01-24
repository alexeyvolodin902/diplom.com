<?php

/**
 * Created by PhpStorm.
 * User: Fandu
 * Date: 11.11.2016
 * Time: 13:38
 */
class Stock
{
    const SHOW_BY_DEFAULT = 6;

    public static function getStockList($page = 1)
    {
        $limit = Stock::SHOW_BY_DEFAULT;
        $offset = ($page-1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();

        $sql = 'SELECT id, text, urlImage FROM orchid.stock '
                        . 'LIMIT :limit OFFSET :offset ';

        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        $result->execute();

        $i = 0;
        $stockList = array();
        while ($row = $result->fetch())
        {
            $stockList[$i]['id'] = $row['id'];
            $stockList[$i]['text'] = $row['text'];
            $stockList[$i]['urlImage'] = $row['urlImage'];
            $i++;
        }

        return $stockList;
    }


    public static function getStockItemById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, text, urlImage FROM orchid.stock WHERE stock.id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();

        return $result->fetch();
    }


    public static function getTotalStocks()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT count(id) AS count FROM orchid.stock';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);

        // Выполнение коменды
        $result->execute();

        // Возвращаем значение count - количество
        $row = $result->fetch();
        return $row['count'];

    }

    public static function getPageNumber($id)
    {
        $page = 1;
        while($id > Stock::SHOW_BY_DEFAULT)
        {
            $page++;
            $id-=Stock::SHOW_BY_DEFAULT;
        }
        return $page;
    }
}