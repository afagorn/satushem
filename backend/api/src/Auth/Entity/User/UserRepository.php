<?php

declare(strict_types=1);

namespace App\Auth\Entity\User;

use DomainException;

interface UserRepository
{
    public function hasByEmail(Email $email): bool;

    public function add(User $user);

    public function findByConfirmToken(string $token): ?User;

    public function findByResetPasswordToken(string $token): ?User;

    public function findByChangeEmailToken(string $token): ?User;

    public function hasByNetwork(NetworkIdentity $networkIdentity): bool;

    /**
     * @param Id $id
     * @return User
     * @throws DomainException
     */
    public function getById(Id $id): User;

    /**
     * @param Email $email
     * @return User
     * @throws DomainException
     */
    public function getByEmail(Email $email): User;

    public function remove(User $user);
}
