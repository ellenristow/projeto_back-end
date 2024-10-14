<?php

require("models/users.php");

$model = new Users();

$users = $model->get();

require("views/register.php");