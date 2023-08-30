<?php

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/App/Helpers/index.php';

require_once __DIR__ . '/config/cli-config.php';

require_once __DIR__ . '/config/cors.php';

$dispatcher = FastRoute\simpleDispatcher(require_once __DIR__ . '/App/Http/Routes/index.php');

$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        jsonResponse([
            'message' => 'Not Found',
            'statusCode' => 404
        ], 404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        jsonResponse([
            'message' => 'Forbidden',
            'statusCode' => 403
        ], 404);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        $controllerClass = $handler[0];
        $method = $handler[1];

        $controllerInstance = new $controllerClass();
        $controllerInstance->$method($vars);
        break;
}
