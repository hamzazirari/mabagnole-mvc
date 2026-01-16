<?php
spl_autoload_register( ... );
$pdo = Database::getInstance( );

$request = $_SERVER['REQUEST_URI' ];
$path = parse_url($request, PHP_URL_PATH);
$path = trim($path, '/');

switch(true) {
case $path ===
$controller = new CategoriesController($pdo);
$controller->listAction();
break;
case preg_match('#^vehicules/(\d+)$#', $path, $matches):
$controller = new VehiculesController($pdo);
$controller->showAction((int)$matches[1]);
break;

'categories':
}
?>