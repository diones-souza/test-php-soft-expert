<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="sales")
 */
class Sale
{
    /** 
     * @Id @Column(type="integer") 
     * @GeneratedValue
     */
    private int $id;

    /**
     * @OneToMany(targetEntity="SaleProduct", mappedBy="sale")
     */
    private $products;

    /** 
     * @Column(type="datetime") 
     */
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->products = new ArrayCollection();
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array|SaleProduct[]
     */
    public function getProducts(): array
    {
        $products = [];

        foreach ($this->products as $item) {
            $products[] = $item->get();
        }

        return $products;
    }

    public function addProduct(SaleProduct $product): void
    {
        $this->products->add($product);
        $product->setSale($this);
    }

    /**
     * Get the value of createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function getTotalPrice(): float
    {
        $total = 0;

        foreach ($this->products as $item) {
            $total += $item->getTotalPrice();
        }

        return $total;
    }

    public function getTotalTax(): float
    {
        $total = 0;

        foreach ($this->products as $item) {
            $total += $item->getTotalTax();
        }

        return $total;
    }

    /**
     * Get the value 
     *
     * @return string
     */
    public function get(): array
    {
        return [
            'id' => $this->id,
            'products' => $this->getProducts(),
            'total_price' => $this->getTotalPrice(),
            'total_tax' => $this->getTotalTax(),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s')
        ];
    }
}
