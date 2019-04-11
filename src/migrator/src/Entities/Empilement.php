<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empilement
 *
 * @ORM\Table(name="empilement")
 * @ORM\Entity
 */
class Empilement
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
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=20, nullable=true, options={"default"="draft"})
     */
    public $status = 'draft';

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
     * @ORM\Column(name="title", type="string", length=200, nullable=true, options={"comment"="Le titre de l'empilement"})
     */
    public $title;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cover", type="integer", nullable=true, options={"unsigned"=true,"comment"="La pochette de la compilation (elle doit �tre carr�e)"})
     */
    public $cover;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true, options={"comment"="Un �ventuel petit mot"})
     */
    public $description;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="published_on", type="date", nullable=true, options={"comment"="La date de publication"})
     */
    public $publishedOn;

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setPublishedOn(\DateTime $date) {
        $this->publishedOn = $date;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
