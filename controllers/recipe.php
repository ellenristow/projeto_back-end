<?php

if (empty($id) || !is_numeric($id)) {
    http_response_code(400);
    include("controllers/error.php");
    exit();
} 

require("models/recipes.php");
require("models/ingredients.php");

$model = new Recipes();
$recipes = $model->getItem($id);

if (empty($recipes)) {
    http_response_code(404);
    include("controllers/error.php");
    exit();
}
$ingredientsModel = new Ingredients();
$ingredients = $ingredientsModel->getItemByRecipe($id);

require("views/recipe.php");