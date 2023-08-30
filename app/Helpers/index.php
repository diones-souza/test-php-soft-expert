<?php

use App\Http\Middleware\JwtMiddleware;
use Symfony\Component\HttpFoundation\Response;

if (!function_exists('auth')) {
    function auth()
    {
        $jwt = new JwtMiddleware();
        return $jwt->user();
    }
}

if (!function_exists('jwt')) {
    function jwt()
    {
        $jwt = new JwtMiddleware();
        return $jwt->handle();
    }
}

if (!function_exists('jsonResponse')) {
    function jsonResponse($data, int $statusCode = 200): Response
    {
        $response = new Response(json_encode($data), $statusCode, ['Content-Type' => 'application/json']);

        return $response->send();
    }
}
