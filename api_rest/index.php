<?php

require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode("/", $uri);

if ((isset($uri[2]) && $uri[2] != 'producto') || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

require PROJECT_ROOT_PATH . '/controller/api/ProductoController.php';

$objFeedController = new ProductoController();

$strMethodName = $uri[3] . 'Action';
$objFeedController->{$strMethodName}();