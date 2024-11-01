<?php

require("models/ingredients.php");
require("models/category.php");
require("models/recipes.php");

$ingredientsModel = new Ingredients();
$ingredients = $ingredientsModel->get();

$categoryModel = new Category();
$categories = $categoryModel->get();

if(isset($_POST["send-image"])) {

    $image = $_FILES["image"];

    $modelRecipe = new Recipes();
    $modelRecipe->addImage($_FILES["image"]);

}

if (isset($_POST["send"])) {

    $image = $_FILES["image"];

    foreach($_POST as $key => $value){

        if (is_array($value)) {
            foreach ($value as &$item) {
                $item = htmlspecialchars(strip_tags(trim($item)));
            }
        } else {
            $_POST[$key] = htmlspecialchars(strip_tags(trim($value)));
        }
    }
  
    if (
        !empty($_POST["title"]) &&
        !empty($_POST["instructions"]) &&
        !empty($_POST["ingredient_id"]) && is_array($_POST["ingredient_id"]) &&
        is_array($_POST["quantity"]) &&
        !empty($_POST["category_id"]) && is_array($_POST["category_id"]) && 
        mb_strlen($_POST["title"]) >= 3 &&
        mb_strlen($_POST["title"]) <= 50 &&
        mb_strlen($_POST["instructions"]) >= 50 &&
        mb_strlen($_POST["instructions"]) <= 2000 &&
        !empty($_FILES["image"]) &&
        $_FILES["image"]["size"] <= (1024 * 1024)  
    ) {
        $imageName = basename($image["name"]);
       
        $modelRecipe = new Recipes();
        $newRecipe = $modelRecipe->create($_POST, $imageName);

        $newImage = $modelRecipe->addImage($_FILES["image"]);
       
        $modelIngredients = new Ingredients();
        $modelIngredients->addIngredient($_POST, $newRecipe["recipe_id"]);

        $modelCategory = new Category();
        $modelCategory->addCategory($_POST, $newRecipe["recipe_id"]);

        header("Location: ".ROOT."/recipe/" . $newRecipe["recipe_id"]); 
        exit();

    } else {
        if 
        (!empty($_FILES["image"]) && $_FILES["image"]["size"] > (1024 * 1024)) {
            $message = "A imagem não pode exceder 1MB";
        }else{ 
            $message = "A receita não foi criada. Verifique os dados e tente novamente.";
        }
    }
}

require("views/recipeform.php");
