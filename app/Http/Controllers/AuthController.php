<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class AuthController
{
    private $service;

    public function __construct()
    {
        $service = new AuthService();
        $this->service = $service;
    }

    public function signIn()
    {
        $request = Request::createFromGlobals()->getContent();

        $data = stripslashes($request);

        $data = json_decode($data, true);

        $validator = Validation::createValidator();

        $constraints = new Assert\Collection([
            'username' => [
                new Assert\NotBlank()
            ],
            'password' => [
                new Assert\NotBlank()
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
            $response = $this->service->signIn($data);

            return jsonResponse($response, $response['statusCode']);
        }
    }

    public function signOut()
    {
        $response = $this->service->signOut();

        return jsonResponse($response, $response['statusCode']);
    }

    public function me()
    {
        try {
            jwt();
            return jsonResponse([
                'message' => 'Success',
                'statusCode' => 200,
                'data' => auth()
            ]);
        } catch (\Exception $e) {
            return jsonResponse([
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ], $e->getCode());
        }
    }
}
