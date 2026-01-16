<?php
spl_autoload_register(function($class) {

if (file_exists("app/models/$class.php")) {
        require "app/models/$class.php";
    }
    elseif (file_exists("app/controllers/$class.php")) {
        require "app/controllers/$class.php";
    }

    elseif (file_exists("config/$class.php")) {
        require "config/$class.php";
    }
});

$pdo = Database::getInstance();

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = trim($path, '/');

switch(true) {
    case $path === 'categories':
        $controller = new CategoriesController($pdo);
        $controller->listAction();
        break;
    case preg_match('#^vehicules/(\d+)$#', $path, $matches):
        $controller = new VehiculesController($pdo);
        $controller->showAction((int)$matches[1]);
        break;
}
?>