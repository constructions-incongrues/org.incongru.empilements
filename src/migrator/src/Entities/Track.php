<?php

namespace Empilements\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Track
 *
 * @ORM\Table(name="track")
 * @ORM\Entity
 */
class Track
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
     * @ORM\Column(name="title", type="string", length=200, nullable=true, options={"comment"="Le titre du morceau"})
     */
    public $title;

    /**
     * @var int|null
     *
     * @ORM\Column(name="position", type="integer", nullable=true, options={"default"="1","unsigned"=true,"comment"="La position du morceau"})
     */
    public $position = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="audio", type="integer", nullable=true, options={"unsigned"=true,"comment"="Le fichier audio du morceau, au format MP3"})
     */
    public $audio;

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setPosition(int $position) {
        $this->position = $position;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAudio(int $id)
    {
        $this->audio = $id;
    }
}
