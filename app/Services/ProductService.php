<?php

namespace App\Services;

use App\Entities\Product;
use App\Entities\Type;

class ProductService
{
    public function getItems()
    {
        try {
            $repo = entityManager->getRepository(Product::class);

            $items = $repo->findAll();

            $products = [];
            foreach ($items as $item) {
                $products[] = $item->get();
            }

            return [
                'message' => 'Success',
                'statusCode' => 200,
                'data' => $products
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
            $repo = entityManager->getRepository(Product::class);

            $product = $repo->find($id);
            if ($product) {
                return [
                    'message' => 'Success',
                    'statusCode' => 200,
                    'data' => $product->get()
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
                || empty(isset($data['type_id']))
                || empty(isset($data['price']))
            ) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $name = $data['name'];
                $price = $data['price'];
                $type_id = $data['type_id'];

                $repo = entityManager->getRepository(Type::class);
                $type = $repo->find($type_id);

                $product = new Product();
                $product->setName($name);
                $product->setPrice($price);
                $product->setType($type);

                entityManager->persist($product);
                entityManager->flush();

                return [
                    'message' => 'Success',
                    'statusCode' => 201,
                    'data' => $product->get()
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
                && empty(isset($data['price']))
                && empty(isset($data['type_id']))
            ) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $repo = entityManager->getRepository(Product::class);

                $product = $repo->find($id);
                if ($product) {
                    if (isset($data['name'])) {
                        $product->setName($data['name']);
                    }

                    if (isset($data['price'])) {
                        $product->setPrice($data['price']);
                    }

                    if (isset($data['type_id'])) {
                        $repo = entityManager->getRepository(Type::class);

                        $protuct_type = $repo->find($data['type_id']);

                        $product->setType($protuct_type);
                    }

                    entityManager->flush();

                    return [
                        'message' => 'Success',
                        'statusCode' => 200,
                        'data' => $product->get()
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
            $repo = entityManager->getRepository(Product::class);

            $product = $repo->find($id);
            if ($product) {
                entityManager->remove($product);
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
