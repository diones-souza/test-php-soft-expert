<?php

namespace App\Services;

use Firebase\JWT\JWT;
use App\Entities\User;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class AuthService
{
    public function signIn(array $data)
    {
        try {
            if (empty(isset($data['username'])) || empty(isset($data['password']))) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $username = $data['username'];
                $password = $data['password'];

                $repo = entityManager->getRepository(User::class);

                $user = $repo->findOneBy(['username' => $username]);

                if ($user && password_verify($password, $user->getPassword())) {
                    $token = $this->generateToken($user->get());

                    return [
                        'message' => 'Success',
                        'statusCode' => 201,
                        'data' => [
                            'user' => $user->get(),
                            'token' => $token
                        ]
                    ];
                }

                return [
                    'message' => 'Invalid credentials',
                    'statusCode' => 400
                ];
            }
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'statusCode' => 400,
            ];
        }
    }

    public function signOut()
    {
        try {
            $token = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

            if (!empty($token)) {
                $token = str_replace('Bearer ', '', $token);

                $cache = new FilesystemAdapter();

                $cache->deleteItem($token);

                return [
                    'message' => 'Success',
                    'statusCode' => 200
                ];
            } else {
                return [
                    'message' => 'Invalid token',
                    'statusCode' => 400
                ];
            }
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ], $e->getCode());
        }
    }

    private function generateToken($payload)
    {
        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        $cache = new FilesystemAdapter();

        $expirationTime = new \DateTime('+1 hour');

        $cacheItem = $cache->getItem($token);
        $cacheItem->expiresAt($expirationTime);
        $cacheItem->set(true);

        $cache->save($cacheItem);

        return $token;
    }
}
