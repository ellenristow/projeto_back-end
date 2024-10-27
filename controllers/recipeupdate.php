<?php

require("models/ingredients.php");
require("models/category.php");
require("models/recipes.php");

$recipeId = null;
if(isset($url_parts[2])){
    $recipeId = intval($url_parts[2]);
}

$modelRecipe = new Recipes();
$recipe = $modelRecipe->getItem($recipeId);

if (!$recipeId) {
    http_response_code(404);
    include("views/error.php");
    exit();
}

if (!$recipe) {
    http_response_code(404);
    include("views/error.php");
    exit();
}

$ingredientsModel = new Ingredients();
$ingredients = $ingredientsModel->getItemByRecipe($recipeId);

$categoryModel = new Category();
$categories = $categoryModel->getItemByRecipe($recipeId);

$categoryIdSelected = [];

if(isset($categories) && is_array($categories)) {
    foreach($categories as $category){
        $categoryIdSelected[] = $category["category_id"];
    }
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
    
    $updatedRecipe = $modelRecipe->update($recipeId, $imageName);

    if ($updatedRecipe) {
        header("Location: ".ROOT."/recipe/" . $recipeId);
        exit();
    } else {
        $message = "A receita não foi atualizada. Verifique os dados e tente novamente.";
    }
}


require("views/recipeupdate.php");

