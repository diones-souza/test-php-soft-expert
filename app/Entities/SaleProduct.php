<?php

namespace App\Entities;

/**
 * @Entity
 * @Table(name="sale_products")
 */
class SaleProduct
{
    /** 
     * @Id @Column(type="integer") 
     * @GeneratedValue 
     */
    private int $id;

    /**
     * @ManyToOne(targetEntity="Sale", inversedBy="products", cascade={"persist"})
     * @JoinColumn(name="sale_id", referencedColumnName="id")
     */
    private Sale $sale;

    /**
     * @ManyToOne(targetEntity="Product")
     * @JoinColumn(name="product_id", referencedColumnName="id")
     */
    private Product $product;

    /**
     * @Column(type="integer")
     */
    private int $quantity;

    public function __construct(Sale $sale, Product $product, int $quantity)
    {
        $this->sale = $sale;
        $this->product = $product;
        $this->quantity = $quantity;
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
     * Get the value of sale
     *
     * @return Sale
     */
    public function getSale(): Sale
    {
        return $this->sale;
    }

    /**
     * Set the value of sale
     *
     * @param Sale $sale
     *
     * @return self
     */
    public function setSale(Sale $sale): self
    {
        $this->sale = $sale;
        return $this;
    }

    /**
     * Get the value of product
     *
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Set the value of product
     *
     * @param Product $product
     *
     * @return self
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * Get the value of quantity
     *
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @param int $quantity
     *
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getTotalPrice(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }

    public function getTotalTax(): float
    {
        return $this->product->getTotalTax() * $this->quantity;
    }

    public function get(): array
    {
        return [
            'id' => $this->id,
            'product' => $this->product->get(),
            'total_tax' => $this->getTotalTax(),
            'quantity' => $this->quantity
        ];
    }
}
