<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusUserRoles
 *
 * @ORM\Table(name="directus_user_roles", uniqueConstraints={@ORM\UniqueConstraint(name="idx_user_role", columns={"user", "role"})})
 * @ORM\Entity
 */
class DirectusUserRoles
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    public $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="user", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $user;

    /**
     * @var int|null
     *
     * @ORM\Column(name="role", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $role;


}
