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

        $decoded_image = base64_decode($image);
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        $tmp = explode(";", $finfo->buffer($decoded_image));
        $media_type = $tmp[0];

        if(
            $decoded_image === false ||
            mb_strlen($image) > 1000000 ||
            !in_array($media_type, $this->allowed_image_formats)
        ) {
            return false;
        }
    }

    public function validateImage($image){



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
    
    public function create ($data) {

        //avaliar a necessidade de todo este codigo validador da imagem. 
       /*  if($this->validator($data) === false){
            return ["error" => "invalid input"];
        } */
        // $_FILES
        /* $bin = base64_decode($data["image"]); */

        $file_name = bin2hex(random_bytes(16));
        $file_extension = ".jpeg"; /* array_search(($data["media_type"]), $this->allowed_image_formats); */
        $full_path = "images/" . $file_name . $file_extension;

        /* file_put_contents($full_path, $bin); */

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
            $full_path //verificR
        ]);
        
        $data["recipe_id"] = $this->db->lastInsertId(); 
        
        return $data;
    }
    
}