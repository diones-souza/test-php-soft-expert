<?php

namespace App\Http\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class JwtMiddleware
{

    public function user()
    {
        $decodedToken = $this->validateToken();

        if ($decodedToken) {
            return $decodedToken;
        } else {
            return null;
        }
    }

    public function handle()
    {
        $decodedToken = $this->validateToken();

        if ($decodedToken) {
            return true;
        } else {
            throw new \Exception('Unauthorized access', 401);
        }
    }

    protected function validateToken()
    {
        try {
            $token = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

            if (!empty($token)) {
                $token = str_replace('Bearer ', '', $token);

                $cache = new FilesystemAdapter();

                $cacheItem = $cache->getItem($token);

                if (!$cacheItem->isHit($token)) {
                    return false;
                }

                return JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
