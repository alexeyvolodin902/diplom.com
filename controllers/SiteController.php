<?php





class SiteController{



    public function actionIndex()
    {          
        $title = "НижТехИнвентаризация";
        require_once(ROOT . '/views/client/index.php');
       
        return true;
    }
        
    
}

