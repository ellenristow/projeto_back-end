<?php

require("models/recipes.php");
require("models/users.php");

$model = new Recipes();
$recipes = $model->get();

$modelUser = new Users();
$users = $modelUser->getItem($id);

require("views/home.php");