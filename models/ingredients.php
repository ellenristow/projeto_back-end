<?php

require_once "base.php";

class Ingredients extends Base {

    public function get(){

        $query = $this->db->prepare("
            SELECT 
                ingredient_id, 
                ingredient_name,
                unit_measurement
            FROM 
                ingredients
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getItem($id){

        $query = $this->db->prepare("
            SELECT 
                ingredient_id, 
                ingredient_name,
                unit_measurement
            FROM 
                ingredients
            WHERE
                ingredient_id = ? 

        ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function getItemByRecipe($id){
        $query = $this->db->prepare("
            
            SELECT 
                i.ingredient_id,
                i.ingredient_name,
                i.unit_measurement,
                rhi.quantity
            FROM
                recipes_has_ingredients rhi
            INNER JOIN
                ingredients i ON rhi.ingredient_id = i.ingredient_id
            WHERE
                rhi.recipe_id = ?
        ");

        $query->execute([$id]);

        return $query->fetchAll();
    }

    public function addIngredient($data, $recipe_id){
        //multiplas vezes
        $query = $this->db->prepare("

            INSERT INTO
                recipes_has_ingredients (recipe_id, ingredient_id, quantity)
            VALUES
                ( ?, ?, ? )

        ");

        $query->execute([
            $recipe_id,
            $data["ingredient_id"],
            $data["quantity"]
        ]);
      
    }
}