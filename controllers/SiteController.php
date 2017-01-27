<?php





class SiteController{



    public function actionIndex()
    {          
        
        require_once(ROOT . '/views/client/index.php');
       
        return true;
    }
        
    
}

