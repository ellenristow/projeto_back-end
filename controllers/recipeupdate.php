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

$categoryModel = new Category();
$categoriesByRecipe = $categoryModel->getItemByRecipe($id);
$categories = $categoryModel->get();

if(isset($categories) && is_array($categories)) {
    foreach($categories as $category){
        $categoryIdSelected[] = $category["category_id"];
    }
}

$ingredientsModel = new Ingredients();
$ingredientsByRecipe = $ingredientsModel->getItemByRecipe($id);
$ingredients = $ingredientsModel->get();

if(isset($ingredients) && is_array($ingredients)) {
    foreach($ingredients as $ingredient){
        $ingredientIdSelected[] = $ingredient["ingredient_id"];
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recipe_category_id'])) {
        $recipeCategoryId = $_POST['recipe_category_id'];
        $categoryIds = $_POST['category_id'];

        $updatedCategory = true;

        foreach ($recipeCategoryId as $index => $recipeCategoryIdValue) {
            $data = [
                "recipe_id" => $id,
                "category_id" => $categoryIds[$index]
            ];

            $updatedCategory = $categoryModel->updateCategory($data, $recipeCategoryIdValue) && $updatedCategory;
        }
    }

    $existingCategoryIds = array_column($categoriesByRecipe, 'category_id');

    foreach($existingCategoryIds as $existingCategoryId){
        
        if (!in_array($existingCategoryId, $categoryIds)){
            $categoryModel->deleteCategoryById($existingCategoryId);
        }
    }

    if ($updatedCategory || $updatedRecipe) {
        $_SESSION['success_message'] = "A receita foi atualizada com sucesso!";

        $recipe = $modelRecipe->getItem($id);
        $categoriesByRecipe = $categoryModel->getItemByRecipe($id);

        header("Location: ".ROOT."/recipe/".$recipe['recipe_id']);
        exit();
    } else {
        $_SESSION['error_message'] = "A receita não foi atualizada. Verifique os dados e tente novamente.";

        header("Location: ".ROOT."/recipeupdate/".$id); 
        exit();
    }
}


require("views/recipeupdate.php");

