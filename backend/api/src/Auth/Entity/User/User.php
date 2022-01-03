<?php

declare(strict_types=1);

namespace App\Auth\Entity\User;

use App\Auth\Service\PasswordHasher;
use ArrayObject;
use DateTimeImmutable;
use DomainException;

class User
{
    private Id $id;
    private Email $email;
    private Status $status;
    private DateTimeImmutable $createdAt;
    private ArrayObject $networks;
    private ?Token $joinConfirmToken;
    private ?Token $resetPasswordToken;
    private ?Token $changeEmailToken;
    private ?Email $newEmail;
    private ?string $passwordHash;
    private Role $role;

    private function __construct(
        Id $id,
        Email $email,
        Status $status,
        DateTimeImmutable $createdAt
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->networks = new ArrayObject();
        $this->role = Role::User();
    }

    public static function requestJoinByEmail(
        Id $id,
        Email $email,
        string $passwordHash,
        DateTimeImmutable $createdAt,
        Token $joinConfirmToken
    ): self {
        $user = new self($id, $email, Status::wait(), $createdAt);
        $user->passwordHash = $passwordHash;
        $user->joinConfirmToken = $joinConfirmToken;

        return $user;
    }

    public static function requestJoinByNetwork(
        Id $id,
        Email $email,
        DateTimeImmutable $createdAt,
        NetworkIdentity $networkIdentity
    ): self {
        $user = new self($id, $email, Status::active(), $createdAt);
        $user->networks->append($networkIdentity);

        return $user;
    }

    public function attachNetwork(NetworkIdentity $network)
    {
        /** @var NetworkIdentity $userNetwork */
        foreach ($this->networks as $userNetwork) {
            if($userNetwork->isEqualTo($network)) {
                throw new DomainException('This network already exist for this user');
            }
        }

        $this->networks->append($network);
    }

    public function confirmJoin(string $token, DateTimeImmutable $date)
    {
        if (is_null($this->joinConfirmToken)) {
            throw new DomainException('Confirmation is not required');
        }

        $this->joinConfirmToken->validate($token, $date);
        $this->status = Status::active();
        $this->joinConfirmToken = null;
    }

    public function requestResetPassword(Token $token, DateTimeImmutable $date): void
    {
        if(!$this->status->isActive()) {
            throw new DomainException('Email user is not confirm');
        }

        if(
            !is_null($this->resetPasswordToken) &&
            !$this->resetPasswordToken->isExpiredTo($date)
        ) {
            throw new DomainException('Reset token is not expired');
        }

        $this->resetPasswordToken = $token;
    }

    public function resetPassword(
        string $token,
        DateTimeImmutable $date,
        string $password,
        PasswordHasher $hasher
    ): void {
        if (is_null($this->resetPasswordToken)) {
            throw new DomainException('Reset password is not required');
        }

        $this->resetPasswordToken->validate($token, $date);
        $this->resetPasswordToken = null;
        $this->passwordHash = $hasher->hash($password);
    }

    public function changePassword(string $current, string $new, PasswordHasher $hasher)
    {
        if (is_null($this->passwordHash)) {
            throw new DomainException('User does not have old password');
        }

        if(!$hasher->validate($current, $this->passwordHash)) {
            throw new DomainException('Current password is not valid');
        }

        $this->passwordHash = $hasher->hash($new);
    }

    public function requestChangeEmail(Token $token, Email $email)
    {
        if(!$this->status->isActive()) {
            throw new DomainException('This user is not active');
        }
        if($this->newEmail->isEqualTo($email)) {
            throw new DomainException('Change email has already been sent on this email');
        }

        $this->changeEmailToken = $token;
    }

    public function ConfirmChangeEmail(string $token, DateTimeImmutable $date)
    {
        if(is_null($this->changeEmailToken) || is_null($this->newEmail)) {
            throw new DomainException('Change email is not requested');
        }
        $this->changeEmailToken->validate($token, $date);

        $this->email = $this->newEmail;
        $this->newEmail = null;
        $this->changeEmailToken = null;
    }

    public function changeRole(Role $role)
    {
        if ($this->role->isEqualTo($role)) {
            throw new DomainException('This role already set');
        }

        $this->role = $role;
    }

    public function remove()
    {
        if (!$this->status->isWait()) {
            throw new DomainException('Active user cannot be deleted');
        }
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return NetworkIdentity[]
     */
    public function getNetworks(): array
    {
        return $this->networks->getArrayCopy();
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }
}
