<?php

namespace App\Infrastructure\Http\Services;

use App\Infrastructure\Persistence\Repositories\UserRepository;
use App\Domain\Entities\User;

class UserService
{
    private UserRepository $_repository;

    public function __construct(UserRepository $repository)
    {
        $this->_repository = $repository;
    }

    public function login(string $email, string $password): bool
    {
        $user = $this->_repository->authenticate($email);
        return password_verify($password, $user->getPassword() ?? '');
    }

    public function register(User $user): bool
    {
        return $this->_repository->add($user);
    }
}