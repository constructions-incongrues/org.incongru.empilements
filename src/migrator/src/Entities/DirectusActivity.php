<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DirectusActivity
 *
 * @ORM\Table(name="directus_activity")
 * @ORM\Entity
 */
class DirectusActivity
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
     * @ORM\Column(name="action", type="string", length=45, nullable=false)
     */
    public $action;

    /**
     * @var int
     *
     * @ORM\Column(name="action_by", type="integer", nullable=false, options={"unsigned"=true})
     */
    public $actionBy = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="action_on", type="datetime", nullable=false)
     */
    public $actionOn;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=50, nullable=false)
     */
    public $ip;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent", type="string", length=255, nullable=false)
     */
    public $userAgent;

    /**
     * @var string
     *
     * @ORM\Column(name="collection", type="string", length=64, nullable=false)
     */
    public $collection;

    /**
     * @var string
     *
     * @ORM\Column(name="item", type="string", length=255, nullable=false)
     */
    public $item;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="edited_on", type="datetime", nullable=true)
     */
    public $editedOn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=65535, nullable=true)
     */
    public $comment;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="comment_deleted_on", type="datetime", nullable=true)
     */
    public $commentDeletedOn;


}
