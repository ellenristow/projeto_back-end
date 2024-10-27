<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define( "ENV", parse_ini_file(".env"));
define("ROOT", "");

$url_parts = explode ("/", $_SERVER["REQUEST_URI"]);

$controller = $url_parts[1];

if(empty($controller)){
    $controller = "home";
}

if(!empty($url_parts[2])){
    $id = $url_parts[2];
}

if(!file_exists("controllers/" .$controller. ".php")){
    http_response_code(404);
    include("controllers/error.php");
    exit();
}

require("controllers/" . $controller . ".php");