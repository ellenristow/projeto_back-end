<?php

require("models/recipes.php");

$model = new Recipes();
$recipes = $model->get();

if(isset ($_POST["recipe_id"])){
    $recipeId = $_POST["recipe_id"];
    $model->addLike($recipeId);
}

require("views/home.php");