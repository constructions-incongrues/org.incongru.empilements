<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusRoles
 *
 * @ORM\Table(name="directus_roles", uniqueConstraints={@ORM\UniqueConstraint(name="idx_group_name", columns={"name"}), @ORM\UniqueConstraint(name="idx_roles_external_id", columns={"external_id"})})
 * @ORM\Entity
 */
class DirectusRoles
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    public $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    public $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ip_whitelist", type="text", length=65535, nullable=true)
     */
    public $ipWhitelist;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nav_blacklist", type="text", length=65535, nullable=true)
     */
    public $navBlacklist;

    /**
     * @var string|null
     *
     * @ORM\Column(name="external_id", type="string", length=255, nullable=true)
     */
    public $externalId;


}
