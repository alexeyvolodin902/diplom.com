<?php





class SiteController{



    public function methodIndex()
    {          
        $title = "НижТехИнвентаризация";
        require_once(ROOT . '/views/client/index.php');
       
        return true;
    }
        
    
}

