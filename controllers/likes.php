<?php
require('models/likes.php');

$model = new Likes();

$likes = $model->getLikesByRecipe($recipe_id);

require('views/home.php');