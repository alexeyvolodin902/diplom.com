<?php
/**
 * Created by PhpStorm.
 * User: alexeivolodin
 * Date: 04.07.16
 * Time: 13:27
 */





class SiteController{



    public function actionIndex()
    {

        //номер активного пункта меню
        //0 - нет активного пункта меню
        $idActiveMenu = 1;
        $slides = Slider::getResourcesSlider();        
        
        require_once(ROOT . '/views/index.php');
       
        return true;
    }
        
    
}

