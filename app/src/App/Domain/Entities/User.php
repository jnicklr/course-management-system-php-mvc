<?php 

namespace App\Domain\Entities;

use DateTimeInterface;

class User
{
    private ?int $_id; 
    private string $_name;
    private string $_description;
    private string $_email;
    private ?string $_password;
    private string $_cpf;
    private ?string $_imageProfile;
    private bool $_isActive;
    private bool $_isAdmin;
    private bool $_isStaff;
    private bool $_isInstructor;
    private DateTimeInterface $_birthDate;
    private DateTimeInterface $_lastLogin;
    private DateTimeInterface $_createdAt;

    public function getId(): ?int
    {
        return $this->_id;
    }

    public function setId(?int $id): void
    {
        $this->_id = $id;
    }

    public function getName(): string
    {
        return $this->_name;
    }

    public function setName(string $name): void
    {
        $this->_name = $name;
    }

    public function getDescription(): string
    {
        return $this->_description;
    }

    public function setDescription(string $description): void
    {
        $this->_description = $description;
    }

    public function getEmail(): string
    {
        return $this->_email;
    }

    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->_password;
    }

    public function setPassword(?string $password): void
    {
        $this->_password = $password;
    }

    public function getCpf(): string
    {
        return $this->_cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->_cpf = $cpf;
    }

    public function getImageProfile(): ?string
    {
        return $this->_imageProfile;
    }

    public function setImageProfile(?string $imageProfile): void
    {
        $this->_imageProfile = $imageProfile;
    }

    public function getIsActive(): bool
    {
        return $this->_isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->_isActive = $isActive;
    }

    public function getIsAdmin(): bool
    {
        return $this->_isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): void
    {
        $this->_isAdmin = $isAdmin;
    }

    public function getIsStaff(): bool
    {
        return $this->_isStaff;
    }

    public function setIsStaff(bool $isStaff): void
    {
        $this->_isStaff = $isStaff;
    }

    public function getIsInstructor(): bool
    {
        return $this->_isInstructor;
    }

    public function setIsInstructor(bool $isInstructor): void
    {
        $this->_isInstructor = $isInstructor;
    }

    public function getBirthDate(): DateTimeInterface
    {
        return $this->_birthDate;
    }

    public function setBirthDate(DateTimeInterface $birthDate): void
    {
        $this->_birthDate = $birthDate;
    }

    public function getLastLogin(): DateTimeInterface
    {
        return $this->_lastLogin;
    }

    public function setLastLogin(DateTimeInterface $lastLogin): void
    {
        $this->_lastLogin = $lastLogin;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->_createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): void
    {
        $this->_createdAt = $createdAt;
    }
}