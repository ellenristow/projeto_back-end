<?php

require_once "base.php";

class Recipes extends Base
{
    public $allowed_image_formats = [
        ".jpg" => "image/jpeg",
        ".avif" => "image/avif",
        ".webp" => "image/webp"
    ];
    
    public function validator($data) {

        if(empty($data)){
            return false;
        }
        
        extract($data);
    
    }

    public function get(): array {
        $query = $this->db->prepare("
            SELECT 
                r.recipe_id, 
                r.user_id, 
                r.title, 
                r.instructions, 
                r.created_at, 
                r.updated_at,
                r.image,
                COUNT(rl.recipe_like) AS like_count,
                GROUP_CONCAT(c.category_name SEPARATOR ', ') AS category
            FROM 
                recipes r
            LEFT JOIN 
                recipes_likes rl ON r.recipe_id = rl.recipe_id
            AND 
                rl.recipe_like = 1
            LEFT JOIN 
                recipes_has_category rhc ON r.recipe_id = rhc.recipe_id
            LEFT JOIN
                category c ON rhc.category_id = c.category_id
            GROUP BY 
                r.recipe_id
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getItem($id){
        $query = $this->db->prepare("
            SELECT
                r.recipe_id, 
                r.user_id, 
                r.title, 
                r.instructions, 
                r.created_at, 
                r.updated_at,
                r.image,
                u.name AS user_name
            FROM 
                recipes r
            INNER JOIN 
                users u ON r.user_id = u.user_id
            WHERE
                recipe_id = ?
        ");

        $query->execute([$id]);

        return $query->fetch();
    }
    
    public function create ($data, $imageName) {

        $query = $this->db->prepare("

            INSERT INTO
                recipes (user_id, title, instructions, image)
            VALUES
                ( ?, ?, ?, ? ) 
        ");
        
        $query->execute([
            $_SESSION["user_id"], 
            $data["title"],
            $data["instructions"], 
            $imageName
        ]);
        
        $data["recipe_id"] = $this->db->lastInsertId(); 
        
        return $data;
    }

    public function addImage($image, $directory = "images/")
    {
        $filePath = $directory . basename($image["name"]);

        if (move_uploaded_file($image["tmp_name"], $filePath)) {
            return true;
        }
        return false;
    }

    public function addLike($recipeId){

        $query = $this->db->prepare("

            INSERT INTO 
                recipes_likes (recipe_id, recipe_like)
            VALUE
                recipe
            (:recipe_id, 1)
        ");
        $query->execute(['recipe_id' => $recipeId]);
    }

    public function update($data, $recipe_id){

        if(!isset($data["title"], $data["instructions"])){
            return false;
        }

        $query = $this->db->prepare("

            SELECT
                image
            FROM 
                recipes
            WHERE
                recipe_id = ?
        ");

        $query->execute(["recipe_id"]);

        $existingImage = $query->fetchColumn();

        $image = isset($data["image"]) && !empty($data["image"]) ? $data["image"] : $existingImage;

        $query = $this->db->prepare("

            UPDATE
                recipes
            SET 
                title = ?,
                instructions = ?,
                image = ?
            WHERE
                recipe_id = ?
        ");

        $query->execute([

            $data["title"],
            $data["instructions"],
            $image,
            $recipe_id
        ]);
    }

    public function delete($recipe_id){

        $query = $this->db->prepare("

            DELETE FROM
                recipes
            WHERE
                recipe_id = ?
        ");

        return $query->execute([$recipe_id]);
    }
}