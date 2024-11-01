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
                c.category_name,
                rhc.recipe_category_id
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
    
    public function updateCategory($data){

        $query = $this->db->prepare("

            UPDATE
                recipes_has_category 
            SET
               category_id = ?
            WHERE
                recipe_category_id = ?
        
        ");

        $query->execute([
            $data["category_id"],
            $data["recipe_category_id"]
        ]);

        return $data;

    }

    public function deleteCategoryById($recipeCategoryId) {

        $query = $this->db->prepare("

            DELETE FROM 
                recipes_has_category 
            WHERE 
                recipe_category_id = :recipe_category_id
        
        ");

        $query->execute([
            ":recipe_category_id" => $recipeCategoryId
        ]);
    }
}

