<?php

require("models/recipes.php");
require("models/likes.php");

$model = new Recipes();
$recipes = $model->get();

$likesModel = new Likes();
foreach($recipes as $key => &$recipe) {
    $likes = $likesModel->getLikesByRecipe($recipe["recipe_id"]);
      var_dump($likes);  
    $recipe["like_count"] = $likes["like_count"];
}

require("views/home.php");