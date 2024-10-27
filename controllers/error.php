<?php
 
$statusCode = http_response_code();
$errorMessage = "An unexpected error has occurred.";
 
$home = ROOT . "/";
 
switch ($statusCode) {
    case 400:
        $errorMessage = "Bad Request.";
        break;
    case 401:
        $errorMessage = "Unauthorized access. Please log in.";
        break;
    case 403:
        $errorMessage = "You do not have permission to access this page.";
        break;
    case 404:
        $errorMessage = "Sorry, page not found.";
        break;
    case 500:
        $errorMessage = "Oops! Something went wrong.";
        break;
    default:
        $errorMessage = "An error has occurred. Please try again later.";
}
 
require("views/error.php");