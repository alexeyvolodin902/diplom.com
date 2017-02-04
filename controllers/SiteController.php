<?php


class SiteController
{


    /*Метод главной страницы клиентской части*/
    public function methodIndex()
    {
              
        $title = "НижТехИнвентаризация";
        require_once(ROOT . '/views/client/index.php');

        return true;
    }


}

