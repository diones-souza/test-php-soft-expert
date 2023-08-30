<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="types")
 */
class Type
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
     * @OneToMany(targetEntity="Tax", mappedBy="type")
     */
    private $taxes;

    /** 
     * @Column(type="datetime") 
     */
    private \DateTime $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->taxes = new ArrayCollection();
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
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array|Taxes[]
     */
    public function getTaxes(): array
    {
        $taxes = [];

        foreach ($this->taxes as $item) {
            $taxes[] = $item->get();
        }

        return $taxes;
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
        $total = 0;

        foreach ($this->taxes as $item) {
            $total += $item->getRate();
        }

        return $total;
    }


    public function get(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'taxes' => $this->getTaxes(),
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
        ];
    }
}
