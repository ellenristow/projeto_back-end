<?php

require("models/recipes.php");
require("models/ingredients.php");

$model = new Recipes();
$recipes = $model->getItem($id);

$ingredientsModel = new Ingredients();
$ingredients = $ingredientsModel->getItemByRecipe($id);

require("views/recipe.php");