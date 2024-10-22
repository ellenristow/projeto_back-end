<?php 

require_once "base.php";

class Category extends Base
{
    public function get(){
        $query = $this->db->prepare("
            SELECT 
                category_id, 
                category_name
            FROM 
                category
        ");

        $query->execute();     

        return $query->fetchAll();
    }
}

