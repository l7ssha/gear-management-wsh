<?php

namespace App\Entity\Auth;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Dto\UserOutputDto;
use App\Provider\User\UserCollectionProvider;
use App\Provider\User\UserItemProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
#[ApiResource(
    operations: [
        new Get(security: "is_granted('ROLE_DISPLAY_USERS')", provider: UserItemProvider::class),
        new GetCollection(security: "is_granted('ROLE_DISPLAY_USERS')", provider: UserCollectionProvider::class),
    ],
    output: UserOutputDto::class
)]
#[UniqueEntity('email')]
#[UniqueEntity('username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    final public const ADMIN_EMAIL = 'admin@example.com';
    final public const ADMIN_ID = '01GFTZHFTNQEABQXB7GJ263VWN';
    final public const ADMIN_USERNAME = 'admin';

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 26)]
    private readonly string $id;

    #[ORM\Column(type: 'string', unique: true)]
    private string $email;

    #[ORM\Column(type: 'string', unique: true)]
    private string $username;

    #[ORM\Column(type: 'string', unique: true)]
    private string $password;

    /** @var Collection<Role> */
    #[ManyToMany(targetEntity: Role::class)]
    private Collection $roles;

    public function __construct(?string $id = null)
    {
        $this->id = $id ?? Ulid::generate();
        $this->roles = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): User
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles
            ->map(static fn (Role $role) => $role->getSymfonyName())
            ->toArray()
        ;
    }

    /**
     * @return Collection<Role>
     */
    public function getRoleObjects(): Collection
    {
        return $this->roles;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }
}
