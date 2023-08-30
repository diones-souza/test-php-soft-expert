<?php

namespace Database\Seeds;

use App\Entities\Product;
use App\Entities\Sale;
use App\Entities\SaleProduct;
use App\Entities\Tax;
use App\Entities\Type;
use App\Entities\User;

require_once __DIR__ . '/../../config/cli-config.php';

class DatabaseSeeder
{
    public function run()
    {
        // Add User
        $user = new User();
        $user->setName('Admin');
        $user->setUsername('admin');
        $user->setAvatar('https://avatars.githubusercontent.com/u/51972715?v=4');
        $user->setPassword(password_hash('password', PASSWORD_DEFAULT));

        entityManager->persist($user);
        entityManager->flush();

        // Add Type
        $type = new Type();
        $type->setName('electronics');

        entityManager->persist($type);
        entityManager->flush();

        // Add Tax
        $tax = new Tax();
        $tax->setName('ICMS');
        $tax->setRate(4);
        $tax->setType($type);

        entityManager->persist($tax);
        entityManager->flush();

        // Add Tax
        $product = new Product();
        $product->setName('TV 40');
        $product->setPrice(3200);
        $product->setType($type);

        entityManager->persist($product);
        entityManager->flush();

        // Add Sale
        $sale = new Sale();

        entityManager->persist($product);
        entityManager->flush();

        // Add SaleProduct
        $sale_product = new SaleProduct($sale, $product, 2);

        entityManager->persist($sale_product);
        entityManager->flush();

        echo "Database seeding completed successfully." . PHP_EOL;
    }
}
