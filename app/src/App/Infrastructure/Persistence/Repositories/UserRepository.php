<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Persistence\Database;
use PDO;

class UserRepository
{
    private PDO $_connection;

    public function __construct(Database $dataBase)
    {
        $this->_connection = $dataBase->getConnection();
    }

    public function add(User $user): bool
    {
        $hash = password_hash($user->getPassword(), PASSWORD_ARGON2ID);
        $query = 'INSERT INTO users (name, email, password) VALUES(:name, :email, :password);';
        $statement = $this->_connection->prepare($query);
        $statement->bindValue(':name', $user->getName(), PDO::PARAM_STR);
        $statement->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $statement->bindValue(':password', $hash, PDO::PARAM_STR);
        return $statement->execute();
    }

    public function authenticate($email): User
    {
        $query = 'SELECT id, email, password FROM users WHERE email = :email';
        
        $statement = $this->_connection->prepare($query);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $userData = $statement->fetch();
        $user = new User();
        $user->setEmail($userData["id"]);
        $user->setPassword($userData["password"]);
        $user->setId($userData["id"]);

        return $user;
    }

    // public function get(int $id): User
    // {
    //     $query = 'SELECT * FROM users WHERE id = :id';
    //     $statement = $this->_connection->prepare($query);
    //     $statement->bindValue(':name', $user->getName(), PDO::PARAM_STR);
    //     $statement->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
    //     $statement->bindValue(':password', $hash, PDO::PARAM_STR);
    //     $statement->bindValue(':cpf', $user->getCpf(), PDO::PARAM_STR);
    //     $statement->bindValue(':birthDate', $user->getBirthDate(), PDO::PARAM_STR);
    //     return $statement->execute();
    // }

    // public function list(): array
    // {

    // }

    // public function remove(int $id): bool
    // {

    // }

    // public function update(int $id): bool
    // {

    // }
}