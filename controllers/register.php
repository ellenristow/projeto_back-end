<?php

if(isset($_POST["send"])){
    
    foreach($_POST as $key => $value){

        $_POST[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    if(
       
        !empty($_POST["name"]) &&
        !empty($_POST["email"]) &&
        !empty($_POST["password"]) &&
        filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
        $_POST["password"] === $_POST["password_confirm"] &&
        mb_strlen($_POST["name"]) >= 3 &&
        mb_strlen($_POST["name"]) <= 100 &&
        mb_strlen($_POST["password"]) >= 8 &&
        mb_strlen($_POST["password"]) <= 255

    ){

        require("models/users.php");
        
        $model = new Users();
        
        $users = $model->getByEmail($_POST["email"]);
        
        if(empty($user)){

            $createUser = $model->create($_POST);

            $_SESSION["user_id"] = $createUser["user_id"];
            header("Location: " . ROOT . "/");

        }else{

            $message = "Email já cadastrado";
        }

    }else{

        $message = "Preencha os dados corretamente";
    }
}

require("views/register.php");