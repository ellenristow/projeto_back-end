<?php

require_once('base.php');

class Likes extends Base
{
    public function getLikesByRecipe($recipe_id)
    {
        $query = $this->db->prepare("
            SELECT 
                COUNT(*) as like_count
            FROM 
                recipes_likes
            WHERE 
                recipe_id = ?
            AND 
                recipe_like = 1 
        ");

        $query->execute([$recipe_id]);

        return $query->fetch();
        
    }

}
