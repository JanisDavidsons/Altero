<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Altero</title>
  <link href="bootstrap-4.3.1-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style.css" rel="stylesheet">
</head>
<body>
<?php
require_once __DIR__ . '/vendor/autoload.php';
session_start();
$dispatcher = FastRoute\simpleDispatcher(
    function (FastRoute\RouteCollector $router) {
        $router->addRoute('GET', '/', 'DealsController@show');
        $router->addRoute('GET', '/getData', 'DealsController@getData');
        $router->addRoute('GET', '/changeStatus/{id}', 'DealsController@changeStatus');
        $router->addRoute('POST', '/store', 'DealsController@store');
    }
);

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        var_dump("not found!!!!");
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $params = $routeInfo[2];

        [$controller, $method] = explode('@', $handler);
        $controllerPath = 'myApp\Controllers\\' . $controller;
        echo (new $controllerPath)->{$method}($params);
        break;
    }
?>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>

</body>
</html>


