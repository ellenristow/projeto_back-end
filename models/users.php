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
                email,
                password
            FROM 
                users
            WHERE
                email = ?
        ");

        $query->execute([$email]);

        return $query->fetch();
    }

}