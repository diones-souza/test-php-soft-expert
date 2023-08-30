<?php

namespace App\Services;

use App\Entities\Product;
use App\Entities\Sale;
use App\Entities\SaleProduct;

class SaleService
{
    public function getItems()
    {
        try {
            $repo = entityManager->getRepository(Sale::class);

            $items = $repo->findAll();

            $sales = [];
            foreach ($items as $item) {
                $sales[] = $item->get();
            }

            return [
                'message' => 'Success',
                'statusCode' => 200,
                'data' => $sales
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
            $repo = entityManager->getRepository(Sale::class);

            $sale = $repo->find($id);
            if ($sale) {
                return [
                    'message' => 'Success',
                    'statusCode' => 200,
                    'data' => $sale->get()
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
            if (empty(isset($data['items']))) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $items = $data['items'];

                $sale = new Sale();
                entityManager->persist($sale);
                entityManager->flush();

                foreach ($items as $item) {
                    $item = (object) $item;
                    $repo = entityManager->getRepository(Product::class);
                    $product = $repo->find($item->product_id);
                    if ($product) {
                        $sale_product = new SaleProduct($sale, $product, $item->quantity);
                        entityManager->persist($sale_product);
                        entityManager->flush();
                        $sale->addProduct($sale_product);
                    }
                }

                return [
                    'message' => 'Success',
                    'statusCode' => 201,
                    'data' => $sale->get()
                ];
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
            $repo = entityManager->getRepository(Sale::class);

            $sale = $repo->find($id);
            if ($sale) {
                entityManager->remove($sale);
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
