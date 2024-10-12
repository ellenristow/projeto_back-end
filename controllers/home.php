<?php

require("models/recipes.php");
require("models/likes.php");

$model = new Recipes();
$recipes = $model->get();



require("views/home.php");