<?php

require_once('base.php');

class Likes extends Base
{
    public function getRecipesWithLikes()
    {
        $query = $this->db->prepare("
            .recipe_id, 
                r.user_id, 
                r.title, 
                r.instructions, 
                r.created_at, 
                r.updated_at,
                COALESCE(COUNT(l.recipe_like), 0) AS like_count
            FROM 
                recipes r
            LEFT JOIN 
                recipes_likes l
            ON 
                r.recipe_id = l.recipe_id
            AND 
                l.recipe_like = 1
            GROUP BY 
                r.recipe_id   recipe_like = ? 
        ");

        $query->execute( [1] );

        return $query->fetch();
        
    }

}
