<?php

require("models/recipes.php");

$model = new Recipes();

$recipes = $model->get();

require("views/home.php");