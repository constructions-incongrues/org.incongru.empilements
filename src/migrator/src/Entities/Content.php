<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Content
 *
 * @ORM\Table(name="content")
 * @ORM\Entity
 */
class Content
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
     * @ORM\Column(name="about", type="text", length=65535, nullable=true, options={"comment"="� propos du projet Empilements"})
     */
    public $about;


}
