<?php

namespace App\Http\Controllers;

use App\Services\SaleService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class SaleController
{
    private $service;

    public function __construct()
    {
        $service = new SaleService();
        $this->service = $service;
    }

    public function getItems()
    {
        try {
            //jwt();
            $response = $this->service->getItems();

            return jsonResponse($response, $response['statusCode']);
        } catch (\Exception $e) {
            jsonResponse([
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ], $e->getCode());
        }
    }

    public function getItem($id)
    {
        try {
            //jwt();
            $response = $this->service->getItem($id);

            return jsonResponse($response, $response['statusCode']);
        } catch (\Exception $e) {
            jsonResponse([
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ], $e->getCode());
        }
    }

    public function create()
    {
        try {
            //jwt();
            $request = Request::createFromGlobals()->getContent();

            $data = stripslashes($request);

            $data = json_decode($data, true);

            $validator = Validation::createValidator();

            $constraints = new Assert\Collection([
                'items' => [
                    new Assert\Type(['type' => 'array']),
                    new Assert\NotBlank(),
                    new Assert\All([
                        'constraints' => [
                            new Assert\Collection([
                                'product_id' => [
                                    new Assert\NotBlank(),
                                ],
                                'quantity' => [
                                    new Assert\NotBlank(),
                                    new Assert\Type(['type' => 'integer']),
                                ],
                            ]),
                        ],
                    ]),
                ]
            ]);

            $errors = $validator->validate($data, $constraints);

            if (count($errors) > 0) {
                $response = [];

                foreach ($errors as $error) {
                    $fieldName = preg_replace('/[\[\]]/', '', $error->getPropertyPath());

                    $errorMessage = $error->getMessage();

                    $response = [
                        ...$response,
                        $fieldName => $errorMessage
                    ];
                }

                return jsonResponse($response, 400);
            } else {
                $response = $this->service->create($data);

                return jsonResponse($response, $response['statusCode']);
            }
        } catch (\Exception $e) {
            jsonResponse([
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ], $e->getCode());
        }
    }

    public function delete($id)
    {
        try {
            //jwt();
            $response = $this->service->delete($id);

            return jsonResponse($response, $response['statusCode']);
        } catch (\Exception $e) {
            jsonResponse([
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ], $e->getCode());
        }
    }
}
