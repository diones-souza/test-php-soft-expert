<?php

namespace App\Entities;

/**
 * @Entity
 * @Table(name="users")
 */
class User
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
     * @Column(type="string") 
     */
    private string $username;

    /** 
     * @Column(type="string") 
     */
    private string $password;

    /** 
     * @Column(type="string", nullable=true) 
     */
    private ?string $avatar;

    /** 
     * @Column(type="datetime") 
     */
    private \DateTime $createdAt;

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
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of avatar
     *
     * @return string
     */
    public function getAvatar(): string
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @param string $avatar
     *
     * @return self
     */
    public function setAvatar(string $avatar): self
    {
        $this->avatar = $avatar;
        return $this;
    }

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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get the value of password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
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

    /**
     * Get the value 
     *
     * @return string
     */
    public function get(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->username,
            'username' => $this->username,
            'avatar' => $this->avatar,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
        ];
    }
}
