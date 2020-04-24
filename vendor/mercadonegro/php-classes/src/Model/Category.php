<?php

namespace Mercadonegro\Model;

use \Mercadonegro\DB\Sql;
use \Mercadonegro\Model;
use \Mercadonegro\Mailer;

class Category extends Model{ //Definir getters e setters para este model.

   
    public static function listAll()
    {

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_categories ORDER BY descategory");


    }

    public function save()
    {
        $sql = new Sql();
        
        $results = $sql->select("CALL sp_categories_save(:idcategory, :descategory)", array(

            ":idcategory"=>$this->getidcategory(),
            ":descategory"=>$this->getdescategory()

        ));

        $this->setData($results[0]);
    }


    public function get($idcategory)
    {
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_categories WHERE idcategory = :idcategory", [
            ':idcategory'=>$idcategory
            
            ]);

            $this->setData($results[0]);
    }

    public function delete()
    {

        $sql = new Sql();

        $sql->query("DELETE FROM tb_categories WHERE idcategory = :idcategory", [
            ':idcategory'=>$this->getidcategory()


        ]);
    }

    }



?>