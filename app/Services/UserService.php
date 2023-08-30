<?php

namespace App\Services;

use App\Entities\User;

class UserService
{
    public function getItems()
    {
        try {
            $repo = entityManager->getRepository(User::class);

            $items = $repo->findAll();

            $users = [];
            foreach ($items as $item) {
                $users[] = $item->get();
            }

            return [
                'message' => 'Success',
                'statusCode' => 200,
                'data' => $users
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'statusCode' => 400,
            ];
        }
    }

    public function getItem($id)
    {
        try {
            $repo = entityManager->getRepository(User::class);

            $user = $repo->find($id);
            if ($user) {
                return [
                    'message' => 'Success',
                    'statusCode' => 200,
                    'data' => $user->get()
                ];
            } else {
                return [
                    'message' => 'Not Found',
                    'statusCode' => 404
                ];
            }
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'statusCode' => 400,
            ];
        }
    }

    public function create(array $data)
    {
        try {
            if (
                empty(isset($data['name']))
                || empty(isset($data['username']))
                || empty(isset($data['avatar']))
                || empty(isset($data['password']))
            ) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $name = $data['name'];
                $username = $data['username'];
                $avatar = $data['avatar'];
                $password = $data['password'];

                $user = new User();
                $user->setName($name);
                $user->setUsername($username);
                $user->setAvatar($avatar);
                $user->setPassword(password_hash($password, PASSWORD_DEFAULT));

                entityManager->persist($user);
                entityManager->flush();

                return [
                    'message' => 'Success',
                    'statusCode' => 201,
                    'data' => $user->get()
                ];
            }
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'statusCode' => 400,
            ];
        }
    }

    public function update($id, array $data)
    {
        try {
            if (
                empty(isset($data['name']))
                && empty(isset($data['username']))
                && empty(isset($data['avatar']))
                && empty(isset($data['password']))
            ) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $repo = entityManager->getRepository(User::class);

                $user = $repo->find($id);
                if ($user) {
                    if (isset($data['name'])) {
                        $user->setName($data['name']);
                    }

                    if (isset($data['username'])) {
                        $user->setUsername($data['username']);
                    }

                    if (isset($data['avatar'])) {
                        $user->setAvatar($data['avatar']);
                    }

                    if (isset($data['password'])) {
                        $user->setPassword(password_hash($data['password'], PASSWORD_DEFAULT));
                    }

                    entityManager->flush();

                    return [
                        'message' => 'Success',
                        'statusCode' => 200,
                        'data' => $user->get()
                    ];
                } else {
                    return [
                        'message' => 'Not Found',
                        'statusCode' => 404
                    ];
                }
            }
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'statusCode' => 400,
            ];
        }
    }

    public function delete($id)
    {
        try {
            $repo = entityManager->getRepository(User::class);

            $user = $repo->find($id);
            if ($user) {
                entityManager->remove($user);
                entityManager->flush();

                return [
                    'message' => 'Success',
                    'statusCode' => 200
                ];
            } else {
                return [
                    'message' => 'Not Found',
                    'statusCode' => 404
                ];
            }
        } catch (\Exception $e) {
            return [
                'message' => $e->getMessage(),
                'statusCode' => 400,
            ];
        }
    }
}
