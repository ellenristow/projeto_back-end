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

    public function getItemByRecipe($id){

        $query = $this->db->prepare("

            SELECT 
                c.category_id, 
                rhc.recipe_id, 
                c.category_name
            FROM
                recipes_has_category rhc
            INNER JOIN
                category c ON rhc.category_id = c.category_id
            WHERE
                rhc.recipe_id = ?       
        ");

        $query->execute([$id]);

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

