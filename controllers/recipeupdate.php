<?php

require("models/ingredients.php");
require("models/category.php");
require("models/recipes.php");

$recipeId = isset($url_parts[2]) ? intval(($url_parts[2])) : null;

if (!$recipeId) {
    http_response_code(404);
    include("views/error.php");
    exit();
}

$modelRecipe = new Recipes();
$recipe = $modelRecipe->getItem($recipeId);

if (!$recipe) {
    http_response_code(404);
    include("views/error.php");
    exit();
}
    
if (isset($_POST["send"])) {
    
    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            foreach ($value as &$item) {
                $item = htmlspecialchars(strip_tags(trim($item)));
            }
        } else {
            $_POST[$key] = htmlspecialchars(strip_tags(trim($value)));
        }
    }

    $image = $_FILES["image"];
    $imageName = basename($image["name"]);
    
    $updatedRecipe = $modelRecipe->update($recipeId, $_POST, $imageName);

    if ($updatedRecipe) {
        header("Location: ".ROOT."/recipe/" . $recipeId);
        exit();
    } else {
        $message = "A receita não foi atualizada. Verifique os dados e tente novamente.";
    }
}


require("views/recipeupdate.php");

