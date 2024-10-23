<?php

require("models/ingredients.php");
require("models/category.php");

$ingredientsModel = new Ingredients();
$ingredients = $ingredientsModel->get();

$categoryModel = new Category();
$categories = $categoryModel->get();

if (isset($_POST["send"])){

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
        !empty($_POST["quantity"]) && is_array($_POST["quantity"]) &&
        !empty($_POST["category_id"]) && is_array($_POST["category_id"]) && 
        mb_strlen($_POST["title"]) >= 3 &&
        mb_strlen($_POST["title"]) <= 50 &&
        mb_strlen($_POST["instructions"]) >= 50 &&
        mb_strlen($_POST["instructions"]) <= 2000 
    ) {
        require("models/recipes.php");
        require("models/ingredients.php");

        $model = new Recipes();
        $newRecipe = $model->create($_POST);

        $model = new Ingredients();
        $model->addIngredient($_POST, $newRecipe["recipe_id"]);

        header("Location: ".ROOT."/recipe");
        exit();

    }    

}

require("views/recipeform.php");
