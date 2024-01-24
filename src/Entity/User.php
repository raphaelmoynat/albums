<?php

namespace App\Entity;


use App\Repository\UserRepository;
use Core\Attributes\TargetRepository;
use Core\Attributes\Table;
use Core\Security\UserAuthentication;


#[TargetRepository(name: UserRepository::class)]
#[Table(name:"users")]
class User extends UserAuthentication
{
    protected int $id;
    protected string $username;
    protected string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAuthenticator()
    {
        return $this->username;
    }

}