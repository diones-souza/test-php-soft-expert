<?php

namespace App\Entities;

use App\Entities\Type;

/**
 * @Entity
 * @Table(name="products")
 */
class Product
{
    /** 
     * @Id @Column(type="integer") 
     * @GeneratedValue 
     */
    private int $id;

    /** 
     * @Column(type="string") 
     */
    private string $name;

    /**
     * @Column(type="decimal", precision=8, scale=2)
     */
    private float $price;

    /**
     * @ManyToOne(targetEntity="Type")
     * @JoinColumn(name="type_id", referencedColumnName="id")
     */
    private Type $type;

    /** 
     * @Column(type="datetime") 
     */
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Get the value of price
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param float $price
     *
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get the value of type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * Set the value of type
     */
    public function setType(Type $type): self
    {
        $this->type = $type;
        return $this;
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

    public function getTotalTax(): float
    {
        return $this->type->getTotalTax();
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
            'name' => $this->name,
            'price' => $this->price,
            'type' => $this->type->get(),
            'total_tax' => $this->getTotalTax(),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s')
        ];
    }
}
