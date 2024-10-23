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

    public function addCategory($data, $recipe_id){

        foreach ($data["category_id"] as $category_id) {

            $query = $this->db->prepare("
                INSERT INTO
                    recipes_has_category ( recipe_id, category_id )
                VALUES
                    ( ?, ? )
            ");
        
            $query->execute([
                $recipe_id,
                $category_id
            ]);
        }

        return $data;
    }    
}

