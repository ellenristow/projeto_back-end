<?php

    if( isset($_POST["send"]) ){

        foreach($_POST as $key => $value){

            $_POST[$key] = htmlspecialchars(strip_tags(trim($value)));
        }

        if( 
            !empty($_POST["email"]) && 
            !empty($_POST["password"]) && 
            filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
            mb_strlen($_POST["password"]) >= 8 &&
            mb_strlen($_POST["password"] <= 1000)

        ){

            require("models/users.php");

            $model = new Users();

            $users = $model->getByEmail($_POST["email"]);

            if(
                !empty($users) &&
                password_verify($_POST["password"], $user["password"])
            ){

                $_SESSION["user_id"] = $users["user_id"];
                header("Location: " . ROOT . "/");

            }else{

                $message = "Usuário ou senha inválidos";
            }
            
        }else{

            $message = "Preencha os dados corretamente";
        }

    }

require("views/login.php");

