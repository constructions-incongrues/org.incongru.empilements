<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artist
 *
 * @ORM\Table(name="artist", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})})
 * @ORM\Entity
 */
class Artist
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
     * @ORM\Column(name="created_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $createdBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=true)
     */
    public $createdOn;

    /**
     * @var int|null
     *
     * @ORM\Column(name="modified_by", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $modifiedBy;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="modified_on", type="datetime", nullable=true)
     */
    public $modifiedOn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=true, options={"comment"="Le nom de l'artiste"})
     */
    public $name;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getId()
    {
        return $this->id;
    }
}
