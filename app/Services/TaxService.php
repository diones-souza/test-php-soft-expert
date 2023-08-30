<?php

namespace App\Services;

use App\Entities\Tax;
use App\Entities\Type;

class TaxService
{
    public function getItems()
    {
        try {
            $repo = entityManager->getRepository(Tax::class);

            $items = $repo->findAll();

            $taxes = [];
            foreach ($items as $item) {
                $taxes[] = $item->get();
            }

            return [
                'message' => 'Success',
                'statusCode' => 200,
                'data' => $taxes
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
            $repo = entityManager->getRepository(Tax::class);

            $tax = $repo->find($id);
            if ($tax) {
                return [
                    'message' => 'Success',
                    'statusCode' => 200,
                    'data' => $tax->get()
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
                empty(isset($data['name'])) ||
                empty(isset($data['type_id'])) ||
                empty(isset($data['rate']))
            ) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $name = $data['name'];
                $rate = $data['rate'];
                $type_id = $data['type_id'];

                $repo = entityManager->getRepository(Type::class);
                $type = $repo->find($type_id);

                $tax = new Tax();
                $tax->setName($name);
                $tax->setRate($rate);
                $tax->setType($type);

                entityManager->persist($tax);
                entityManager->flush();

                return [
                    'message' => 'Success',
                    'statusCode' => 201,
                    'data' => $tax->get()
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
                empty(isset($data['name'])) &&
                empty(isset($data['type_id'])) &&
                empty(isset($data['rate']))
            ) {
                return [
                    'message' => 'Invalid parameters',
                    'statusCode' => 400
                ];
            } else {
                $repo = entityManager->getRepository(Tax::class);

                $tax = $repo->find($id);
                if ($tax) {
                    if (isset($data['name'])) {
                        $tax->setName($data['name']);
                    }

                    if (isset($data['rate'])) {
                        $tax->setRate($data['rate']);
                    }

                    if (isset($data['type_id'])) {
                        $repo = entityManager->getRepository(Type::class);

                        $protuct_type = $repo->find($data['type_id']);

                        $tax->setType($protuct_type);
                    }

                    entityManager->flush();

                    return [
                        'message' => 'Success',
                        'statusCode' => 200,
                        'data' => $tax->get()
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
            $repo = entityManager->getRepository(Tax::class);

            $tax = $repo->find($id);
            if ($tax) {
                entityManager->remove($tax);
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
