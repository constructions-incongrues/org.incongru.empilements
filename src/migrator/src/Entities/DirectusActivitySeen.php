<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusActivitySeen
 *
 * @ORM\Table(name="directus_activity_seen")
 * @ORM\Entity
 */
class DirectusActivitySeen
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
     * @var int
     *
     * @ORM\Column(name="activity", type="integer", nullable=false, options={"unsigned"=true})
     */
    public $activity;

    /**
     * @var int
     *
     * @ORM\Column(name="user", type="integer", nullable=false, options={"unsigned"=true})
     */
    public $user = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="seen_on", type="datetime", nullable=true)
     */
    public $seenOn;

    /**
     * @var bool
     *
     * @ORM\Column(name="archived", type="boolean", nullable=false)
     */
    public $archived = '0';


}
