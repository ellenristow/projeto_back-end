<?php

require_once "base.php";

class Recipes extends Base
{
    public function get(): array {
        $query = $this->db->prepare("
            SELECT 
                r.recipe_id, 
                r.user_id, 
                r.title, 
                r.instructions, 
                r.created_at, 
                r.updated_at,
                COUNT(rl.recipe_like) AS like_count
            FROM 
                recipes r
            LEFT JOIN 
                recipes_likes rl ON r.recipe_id = rl.recipe_id
            AND 
                rl.recipe_like = 1
            GROUP BY 
                r.recipe_id
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getItem($id){
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
                WHERE
                    recipe_id = ?
            ");

        $query->execute([$id]);

        return $query->fetch();
    } 
}