<?php

require_once "base.php";

class Recipes extends Base
{
    public function get(): array {
        $query = $this->db->prepare("
            SELECT 
                recipe_id, 
                user_id, 
                title, 
                instructions, 
                created_at, 
                updated_at
            FROM 
                recipes
        
        ");

        $query->execute();

        var_dump($query->fetchAll());

        return $query->fetchAll();
    }
}