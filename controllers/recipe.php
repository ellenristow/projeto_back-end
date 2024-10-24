<?php

if (empty($id) || !is_numeric($id)) {
    http_response_code(400);
    die("Invalid Request");
} 

require("models/recipes.php");
require("models/ingredients.php");

$model = new Recipes();
$recipes = $model->getItem($id);

if (empty($recipes)) {
    http_response_code(404);
    die("Not Found");
}

$ingredientsModel = new Ingredients();
$ingredients = $ingredientsModel->getItemByRecipe($id);

require("views/recipe.php");