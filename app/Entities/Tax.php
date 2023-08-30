<?php

namespace App\Entities;

/**
 * @Entity
 * @Table(name="taxes")
 */
class Tax
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
    private float $rate;

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
     * Get the value of rate
     *
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param float $rate
     *
     * @return void
     */
    public function setRate(float $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * Get the value of type
     *
     * @return Type|null
     */
    public function getType(): Type|null
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @param Type|null $type
     *
     * @return void
     */
    public function setType(Type|null $type): void
    {
        $this->type = $type;
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
            'rate' => $this->rate,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
        ];
    }
}
