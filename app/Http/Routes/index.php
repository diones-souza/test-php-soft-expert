<?php

use FastRoute\RouteCollector;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\SaleController;

return function (RouteCollector $routes) {
    $routes->addGroup('/api', function (RouteCollector $route) {
        $route->addGroup('/auth', function (RouteCollector $route) {
            $route->post('/sign-in', [AuthController::class, 'signIn']);
            $route->post('/sign-out', [AuthController::class, 'signOut']);
            $route->get('/me', [AuthController::class, 'me']);
        });

        $route->addGroup('/users', function (RouteCollector $route) {
            $route->get('', [UserController::class, 'getItems']);
            $route->get('/{id:\d+}', [UserController::class, 'getItem']);
            $route->post('/create', [UserController::class, 'create']);
            $route->put('/update/{id:\d+}', [UserController::class, 'update']);
            $route->delete('/delete/{id:\d+}', [UserController::class, 'delete']);
        });

        $route->addGroup('/products', function (RouteCollector $route) {
            $route->get('', [ProductController::class, 'getItems']);
            $route->get('/{id:\d+}', [ProductController::class, 'getItem']);
            $route->post('/create', [ProductController::class, 'create']);
            $route->put('/update/{id:\d+}', [ProductController::class, 'update']);
            $route->delete('/delete/{id:\d+}', [ProductController::class, 'delete']);

            $route->addGroup('/types', function (RouteCollector $route) {
                $route->get('', [TypeController::class, 'getItems']);
                $route->get('/{id:\d+}', [TypeController::class, 'getItem']);
                $route->post('/create', [TypeController::class, 'create']);
                $route->put('/update/{id:\d+}', [TypeController::class, 'update']);
                $route->delete('/delete/{id:\d+}', [TypeController::class, 'delete']);
            });

            $route->addGroup('/taxes', function (RouteCollector $route) {
                $route->get('', [TaxController::class, 'getItems']);
                $route->get('/{id:\d+}', [TaxController::class, 'getItem']);
                $route->post('/create', [TaxController::class, 'create']);
                $route->put('/update/{id:\d+}', [TaxController::class, 'update']);
                $route->delete('/delete/{id:\d+}', [TaxController::class, 'delete']);
            });
        });

        $route->addGroup('/sales', function (RouteCollector $route) {
            $route->get('', [SaleController::class, 'getItems']);
            $route->get('/{id:\d+}', [SaleController::class, 'getItem']);
            $route->post('/create', [SaleController::class, 'create']);
            $route->put('/update/{id:\d+}', [SaleController::class, 'update']);
            $route->delete('/delete/{id:\d+}', [SaleController::class, 'delete']);
        });
    });
};
