<?php
require_once('base.php');

class Users extends Base
{

    public function get(){

        $query = $this->db->prepare("
        
            SELECT
                user_id, 
                name, 
                email, 
                password,
                created_at,
                updated_at
            FROM
                users
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getItem($id){

        $query = $this->db->prepare("

            SELECT
                user_id, 
                name, 
                email, 
                password,
                created_at,
                updated_at
            FROM
                users
            WHERE
                user_id = ?    

        ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function getByEmail($email){

        $query = $this->db->prepare("

            SELECT 
                user_id,
                password,
                name
            FROM 
                users
            WHERE
                email = ?     
        ");

        $query->execute([$email]);

        return $query->fetch();
    }

    public function create($data){

        $api_key = bin2hex(random_bytes(16));

        $query = $this->db->prepare("

            INSERT INTO 
                users (name, email, password, api_key)
            VALUES 
                (?, ?, ?, ?)
        ");

        $query->execute([
            $data["name"],
            $data["email"],
            password_hash( $data["password"], PASSWORD_DEFAULT ),
            $api_key
        ]);

        $data["user_id"] = $this->db->lastInsertId();
        $data["api_key"] = $api_key;

        return $data;
    }

}