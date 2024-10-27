<?php 

require("models/users.php");

$model = new Users();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
} else {
    http_response_code(400); 
    include("controllers/error.php");
    exit();
}

$user = $model->getItem($id);

if (!$user) {
    http_response_code(404);
    include("controllers/error.php");
    exit();
}

if (isset($_POST["delete"])) {

    $deleteUser = $model->delete($id);

    if ($deleteUser) {
        session_destroy();
        header("Location: ".ROOT . "/");
        exit();
    }else{
        $message = "Não foi possível deletar sua conta. Tente novamente.";
    }

}


require("views/profile.php");
