<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmpilementCurator
 *
 * @ORM\Table(name="empilement_curator")
 * @ORM\Entity
 */
class EmpilementCurator
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
     * @ORM\Column(name="empilement_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $empilementId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="curator_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $curatorId;


}
