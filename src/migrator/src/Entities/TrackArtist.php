<?php

namespace Empilements\Entities;


use Doctrine\ORM\Mapping as ORM;

/**
 * TrackArtist
 *
 * @ORM\Table(name="track_artist")
 * @ORM\Entity
 */
class TrackArtist
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
     * @ORM\Column(name="track_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $trackId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="artist_id", type="integer", nullable=true, options={"unsigned"=true})
     */
    public $artistId;

    public function setTrackId(int $id)
    {
        $this->trackId = $id;
    }

    public function setArtistId(int $id)
    {
        $this->artistId = $id;
    }

}
