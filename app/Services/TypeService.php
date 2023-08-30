<?php

namespace App\Services;

use App\Entities\Type;

class TypeService
{
    public function getItems()
    {
        try {
            $repo = entityManager->getRepository(Type::class);

            $items = $repo->findAll();

            $types = [];
            foreach ($items as $item) {
                $types[] = $item->get();
            }

            return [
                'message' => 'Success',
                'statusCode' => 200,
                'data' => $types
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
            $repo = entityManager->getRepository(Type::class);

            $type = $repo->find($id);
            if ($type) {
                return [
                    'message' => 'Success',
                    'statusCode' => 200,
                    'data' => $type->get()
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
            if (empty(isset($data['name']))) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $name = $data['name'];

                $type = new Type();
                $type->setName($name);

                entityManager->persist($type);
                entityManager->flush();

                return [
                    'message' => 'Success',
                    'statusCode' => 201,
                    'data' => $type->get()
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
            if (empty(isset($data['name']))) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $name = $data['name'];

                $repo = entityManager->getRepository(Type::class);

                $type = $repo->find($id);
                if ($type) {
                    $type->setName($name);

                    entityManager->flush();

                    return [
                        'message' => 'Success',
                        'statusCode' => 200,
                        'data' => $type->get()
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
            $repo = entityManager->getRepository(Type::class);

            $data = $repo->find($id);
            if ($data) {
                entityManager->remove($data);
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
