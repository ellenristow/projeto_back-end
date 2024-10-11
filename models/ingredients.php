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
            JOIN
                ingredients i ON rhi.ingredient_id = i.ingredient_id
            WHERE
                rhi.recipe_id = ?
        ");

        $query->execute([$id]);

        return $query->fetchAll();
    }
}