<?php

namespace Mercadonegro; 

class PageAdmin extends Page{ //Extend a Page. We're done here.

    public function __construct($opts = array(), $tpl_dir = "/views/admin/")
    {
        parent::__construct($opts, $tpl_dir);

    }

}




?>