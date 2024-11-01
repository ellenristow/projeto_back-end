<?php

if (empty($id) || !is_numeric($id)) {
    http_response_code(400);
    include("controllers/error.php");
    exit();
} 

require("models/ingredients.php");
require("models/category.php");
require("models/recipes.php");

$modelRecipe = new Recipes();
$recipe = $modelRecipe->getItem($id);

if (empty($recipe)) {
    http_response_code(404);
    include("views/error.php");
    exit();
}

$ingredientsModel = new Ingredients();
$ingredientsByRecipe = $ingredientsModel->getItemByRecipe($id);
$ingredients = $ingredientsModel->get();

if(isset($ingredients) && is_array($ingredients)) {
    foreach($ingredients as $ingredient){
        $ingredientIdSelected[] = $ingredient["ingredient_id"];
    }
}

$categoryModel = new Category();
$categoriesByRecipe = $categoryModel->getItemByRecipe($id);
$categories = $categoryModel->get();

if(isset($categories) && is_array($categories)) {
    foreach($categories as $category){
        $CategoryIdSelected[] = $category["category_id"];
    }
}

if (isset($_POST["send"])) {

    /* echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    exit(); */

    foreach ($_POST as $key => $value) {
        if (is_array($value)) {
            foreach ($value as &$item) {
                $item = htmlspecialchars(strip_tags(trim($item)));
            }
        } else {
            $_POST[$key] = htmlspecialchars(strip_tags(trim($value)));
        }
    }

    $image = isset($_FILES["image"]) ? $_FILES["image"] : null;
    $imageName = $image && $image["error"] == 0 ? basename($image["name"]) : $recipe["image"];

    $data = [
        "title" => $_POST["title"],
        "instructions" => $_POST["instructions"],
        "image" => $imageName
    ];
    
    $updatedRecipe = $modelRecipe->update($data, $id);

    if($image && $image["error"] == 0){
        $modelRecipe->addImage($image);
    }

    if (!empty($_POST["recipe_ingredient_id"]) && !empty($_POST["ingredient_id"])) {
        $recipeIngredientId = $_POST["recipe_ingredient_id"];
        $IngredientIds = $_POST["ingredient_id"];

        foreach ($recipeIngredientId as $index => $recipeIngredientIdValue) {
            $data = [
                "recipe_ingredient_id" => $recipeIngredientIdValue,
                "recipe_id" => $id,
                "ingredient_id" => $IngredientIds[$index]
            ];

            $updatedCategory = $categoryModel->updateCategory($data);
        }
    }

    if (!empty($_POST["recipe_ingredient_id"]) && !empty($_POST["ingredient_id"])) {
        $recipeIngredientId = $_POST["recipe_ingredient_id"];
        $ingredientIds = $_POST["ingredient_id"];

        foreach ($recipeIngredientId as $index => $recipeIngredientIdValue) {
            $data = [
                "recipe_ingredient_id" => $recipeIngredientIdValue,
                "recipe_id" => $id,
                "ingredient_id" => $ingredientIds[$index], 
                "quantity" => $quanitities[$index]
            ];

            $updatedIngredient = $ingredientsModel->updateIngredients($data);
        }
    }

    if ($updatedCategory || $updatedIngredient) {
        header("Location: ".ROOT."/");
        exit();
    } else {
        $message = "A receita não foi atualizada. Verifique os dados e tente novamente.";
    }
}


require("views/recipeupdate.php");

